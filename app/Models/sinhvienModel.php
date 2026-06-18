<?php
require_once __DIR__ . '/../Core/DB.php'; 

class sinhvienModel {
    private $conn;

    public function __construct() {
        $this->conn = ConnectDB::Connect();
    }

    public function paging($limit = 5, $offset = 0, $search = "", $lop = "", $sort = '', $dir = 'asc') {
        // If no search, use SQL with limit/offset for performance
        $search = trim($search);
        $lop = trim($lop);
        // No search keywords: use SQL and optionally filter by class in WHERE for performance
        if ($search === '') {
            if ($lop === '') {
                $order = '';
                if (in_array($sort, ['mssv','hoten','lop','gioi_tinh'])) {
                    $order = " ORDER BY s." . $sort . " " . (strtoupper($dir) === 'DESC' ? 'DESC' : 'ASC');
                }
                $query = "SELECT s.id, s.mssv, s.hoten, s.gioi_tinh, s.lop FROM students s" . $order . " LIMIT :limit OFFSET :offset";
                $stmt = $this->conn->prepare($query);
                $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
                $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
                $stmt->execute();
                $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $queryTotal = "SELECT COUNT(*) FROM students s";
                $totalRecord = $this->conn->query($queryTotal)->fetchColumn();

                return [ 'data' => $data, 'totalRecord' => $totalRecord ];
            } else {
                $order = '';
                if (in_array($sort, ['mssv','hoten','lop','gioi_tinh'])) {
                    $order = " ORDER BY s." . $sort . " " . (strtoupper($dir) === 'DESC' ? 'DESC' : 'ASC');
                }
                $query = "SELECT s.id, s.mssv, s.hoten, s.gioi_tinh, s.lop FROM students s WHERE s.lop = :lop" . $order . " LIMIT :limit OFFSET :offset";
                $stmt = $this->conn->prepare($query);
                $stmt->bindValue(':lop', $lop, PDO::PARAM_STR);
                $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
                $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
                $stmt->execute();
                $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

                $queryTotal = "SELECT COUNT(*) FROM students s WHERE s.lop = :lop";
                $stmtTotal = $this->conn->prepare($queryTotal);
                $stmtTotal->bindValue(':lop', $lop, PDO::PARAM_STR);
                $stmtTotal->execute();
                $totalRecord = $stmtTotal->fetchColumn();

                return [ 'data' => $data, 'totalRecord' => $totalRecord ];
            }
        }

        // Prefer SQL search on search_text column (accent-insensitive) if column exists
        try {
            $colCheck = $this->conn->query("SHOW COLUMNS FROM students LIKE 'search_text'")->fetch();
        } catch (Exception $e) {
            $colCheck = false;
        }

        if ($colCheck) {
            // normalize search tokens in PHP then use SQL LIKE on search_text
            $normalize = function($str) {
                $str = mb_strtolower($str, 'UTF-8');
                $map = array(
                    'a' => 'à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ',
                    'e' => 'è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ',
                    'i' => 'ì|í|ị|ỉ|ĩ',
                    'o' => 'ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ',
                    'u' => 'ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ',
                    'y' => 'ỳ|ý|ỵ|ỷ|ỹ',
                    'd' => 'đ',
                );
                foreach ($map as $latin => $unicode) {
                    $str = preg_replace('/(' . $unicode . ')/u', $latin, $str);
                }
                $str = preg_replace('/\p{M}/u', '', $str);
                $str = preg_replace('/\s+/u', ' ', trim($str));
                return $str;
            };

            $tokens = preg_split('/\s+/', $search);
            $tokens = array_map(function($t) use ($normalize) { return $normalize($t); }, $tokens);

            $conds = [];
            $params = [];
            foreach ($tokens as $i => $tok) {
                if ($tok === '') continue;
                $key = ":tok$i";
                $conds[] = "s.search_text LIKE $key";
                $params[$key] = "%$tok%";
            }

            $where = '';
            if (!empty($conds)) $where = 'WHERE ' . implode(' AND ', $conds);
            if ($lop !== '') {
                $where .= ($where === '' ? 'WHERE ' : ' AND ') . 's.lop = :lop';
                $params[':lop'] = $lop;
            }

            $order = '';
            if (in_array($sort, ['mssv','hoten','lop','gioi_tinh'])) {
                $order = " ORDER BY s." . $sort . " " . (strtoupper($dir) === 'DESC' ? 'DESC' : 'ASC');
            }
            $query = "SELECT s.id, s.mssv, s.hoten, s.gioi_tinh, s.lop FROM students s $where" . $order . " LIMIT :limit OFFSET :offset";
            $stmt = $this->conn->prepare($query);
            foreach ($params as $k => $v) {
                if ($k === ':lop') $stmt->bindValue($k, $v, PDO::PARAM_STR);
                else $stmt->bindValue($k, $v, PDO::PARAM_STR);
            }
            $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
            $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $queryTotal = "SELECT COUNT(*) FROM students s $where";
            $stmtTotal = $this->conn->prepare($queryTotal);
            foreach ($params as $k => $v) {
                if ($k === ':lop') $stmtTotal->bindValue($k, $v, PDO::PARAM_STR);
                else $stmtTotal->bindValue($k, $v, PDO::PARAM_STR);
            }
            $stmtTotal->execute();
            $totalRecord = $stmtTotal->fetchColumn();

            return [ 'data' => $data, 'totalRecord' => $totalRecord ];
        }

        // Fallback: if search_text not available, do PHP-based normalize+filter (previous behavior)
        $allQuery = "SELECT s.id, s.mssv, s.hoten, s.gioi_tinh, s.lop FROM students s";
        $stmtAll = $this->conn->prepare($allQuery);
        $stmtAll->execute();
        $all = $stmtAll->fetchAll(PDO::FETCH_ASSOC);

        // normalize function (remove Vietnamese diacritics)
        $normalize = function($str) {
            $str = mb_strtolower($str, 'UTF-8');
            $map = array(
                'a' => 'à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ',
                'e' => 'è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ',
                'i' => 'ì|í|ị|ỉ|ĩ',
                'o' => 'ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ',
                'u' => 'ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ',
                'y' => 'ỳ|ý|ỵ|ỷ|ỹ',
                'd' => 'đ',
            );
            foreach ($map as $latin => $unicode) {
                $str = preg_replace('/(' . $unicode . ')/u', $latin, $str);
            }
            $str = preg_replace('/\p{M}/u', '', $str);
            $str = preg_replace('/\s+/u', ' ', trim($str));
            return $str;
        };

        $tokens = preg_split('/\s+/', $search);
        $tokens = array_map(function($t) use ($normalize) { return $normalize($t); }, $tokens);

        $filtered = [];
        foreach ($all as $row) {
            $hay_mssv = $normalize($row['mssv'] ?? '');
            $hay_hoten = $normalize($row['hoten'] ?? '');
            $match = true;
            foreach ($tokens as $tok) {
                if ($tok === '') continue;
                if (strpos($hay_mssv, $tok) === false && strpos($hay_hoten, $tok) === false) {
                    $match = false; break;
                }
            }
            if ($match) {
                if ($lop !== '' && (trim($row['lop'] ?? '') !== $lop)) {
                    // skip
                } else {
                    $filtered[] = $row;
                }
            }
        }

        // Apply sorting on filtered results (PHP) if requested
        if (in_array($sort, ['mssv','hoten','lop','gioi_tinh'])) {
            usort($filtered, function($a, $b) use ($sort, $dir) {
                $ka = strtolower(trim($a[$sort] ?? ''));
                $kb = strtolower(trim($b[$sort] ?? ''));
                if ($sort === 'hoten') { // normalize diacritics for name compare
                    $normalize = function($str) {
                        $str = mb_strtolower($str, 'UTF-8');
                        $map = array('a' => 'à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ','e' => 'è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ','i' => 'ì|í|ị|ỉ|ĩ','o' => 'ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ','u' => 'ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ','y' => 'ỳ|ý|ỵ|ỷ|ỹ','d' => 'đ');
                        foreach ($map as $latin => $unicode) { $str = preg_replace('/(' . $unicode . ')/u', $latin, $str); }
                        $str = preg_replace('/\p{M}/u', '', $str);
                        $str = preg_replace('/\s+/u', ' ', trim($str));
                        return $str;
                    };
                    $ka = $normalize($a['hoten'] ?? '');
                    $kb = $normalize($b['hoten'] ?? '');
                }
                if ($ka == $kb) return 0;
                if (strtoupper($dir) === 'DESC') return ($ka < $kb) ? 1 : -1;
                return ($ka < $kb) ? -1 : 1;
            });
        }

        $totalRecord = count($filtered);
        $data = array_slice($filtered, (int)$offset, (int)$limit);

        return [ 'data' => $data, 'totalRecord' => $totalRecord ];
    }

    public function create($mssv, $hoten, $gioi_tinh, $lop) {
        // compute normalized search_text (mssv + hoten)
        $normalize = function($str) {
            $str = mb_strtolower($str, 'UTF-8');
            $map = array(
                'a' => 'à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ',
                'e' => 'è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ',
                'i' => 'ì|í|ị|ỉ|ĩ',
                'o' => 'ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ',
                'u' => 'ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ',
                'y' => 'ỳ|ý|ỵ|ỷ|ỹ',
                'd' => 'đ',
            );
            foreach ($map as $latin => $unicode) {
                $str = preg_replace('/(' . $unicode . ')/u', $latin, $str);
            }
            $str = preg_replace('/\p{M}/u', '', $str);
            $str = preg_replace('/\s+/u', ' ', trim($str));
            return $str;
        };

        $search_text = $normalize(trim($mssv . ' ' . $hoten));

        // try inserting with search_text column if exists
        try {
            $colCheck = $this->conn->query("SHOW COLUMNS FROM students LIKE 'search_text'")->fetch();
        } catch (Exception $e) {
            $colCheck = false;
        }

        if ($colCheck) {
            $sql = "INSERT INTO students (mssv, hoten, gioi_tinh, lop, search_text) VALUES (:mssv, :hoten, :gioi_tinh, :lop, :search_text)";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([':mssv' => $mssv, ':hoten' => $hoten, ':gioi_tinh' => $gioi_tinh, ':lop' => $lop, ':search_text' => $search_text]);
        } else {
            $sql = "INSERT INTO students (mssv, hoten, gioi_tinh, lop) VALUES (:mssv, :hoten, :gioi_tinh, :lop)";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([':mssv' => $mssv, ':hoten' => $hoten, ':gioi_tinh' => $gioi_tinh, ':lop' => $lop]);
        }
    }

    public function getById($id) {
        $sql = "SELECT s.id, s.mssv, s.hoten, s.gioi_tinh, s.lop 
                FROM students s
                WHERE s.id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $mssv, $hoten, $gioi_tinh, $lop) {
        $normalize = function($str) {
            $str = mb_strtolower($str, 'UTF-8');
            $map = array(
                'a' => 'à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ',
                'e' => 'è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ',
                'i' => 'ì|í|ị|ỉ|ĩ',
                'o' => 'ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ',
                'u' => 'ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ',
                'y' => 'ỳ|ý|ỵ|ỷ|ỹ',
                'd' => 'đ',
            );
            foreach ($map as $latin => $unicode) {
                $str = preg_replace('/(' . $unicode . ')/u', $latin, $str);
            }
            $str = preg_replace('/\p{M}/u', '', $str);
            $str = preg_replace('/\s+/u', ' ', trim($str));
            return $str;
        };

        $search_text = $normalize(trim($mssv . ' ' . $hoten));

        try {
            $colCheck = $this->conn->query("SHOW COLUMNS FROM students LIKE 'search_text'")->fetch();
        } catch (Exception $e) {
            $colCheck = false;
        }

        if ($colCheck) {
            $sql = "UPDATE students SET mssv = :mssv, hoten = :hoten, gioi_tinh = :gioi_tinh, lop = :lop, search_text = :search_text WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([':mssv' => $mssv, ':hoten' => $hoten, ':gioi_tinh' => $gioi_tinh, ':lop' => $lop, ':search_text' => $search_text, ':id' => $id]);
        } else {
            $sql = "UPDATE students SET mssv = :mssv, hoten = :hoten, gioi_tinh = :gioi_tinh, lop = :lop WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([':mssv' => $mssv, ':hoten' => $hoten, ':gioi_tinh' => $gioi_tinh, ':lop' => $lop, ':id' => $id]);
        }
    }

    public function delete($id) {
        $sql = "DELETE FROM students WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}
?> 