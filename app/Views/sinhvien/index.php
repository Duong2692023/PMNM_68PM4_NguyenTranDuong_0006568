<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title><?php echo $data['page_title']; ?></title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background-color: #f0f2f5; }
        .header { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 20px; }
        .header h2 { margin-bottom: 10px; }
        .container { max-width: 1400px; margin: 0 auto; padding: 20px; }
        .title-row { display:flex; align-items:center; justify-content:space-between; margin-bottom:10px; }
        .title-row h2 { font-size:20px; color:#343a40; margin:0; font-weight:600; }
        .count-badge { background:#6c757d; color:#fff; padding:3px 8px; border-radius:6px; font-size:12px; margin-left:8px; }

        .search-panel { background: white; padding: 12px 16px; border-radius: 6px; margin-bottom: 16px; display:flex; align-items:center; justify-content:space-between; gap:12px; border:1px solid #e9ecef; }
        .filters { display:flex; gap:10px; align-items:center; }
        .filters form { display:flex; gap:10px; align-items:center; margin:0; }
        .filters input[type="text"], .filters select, .filters .btn-search, .filters .btn-reset, .filters a { height:40px; padding:6px 12px; border:1px solid #ced4da; border-radius:4px; font-size:14px; box-sizing: border-box; display:inline-flex; align-items:center; }
        .filters input[type="text"] { line-height:18px; }
        .filters select { line-height:18px; }
        .filters input[type="text"] { width:320px; }
        .filters select { min-width:180px; background:#fff; }
        .filters .btn-search { background:#007bff; color:#fff; border:none; padding:0 14px; justify-content:center; }
        .filters .btn-reset { background:#fff; color:#212529; border:1px solid #ced4da; padding:0 12px; justify-content:center; }
        .controls-right { display:flex; gap:12px; align-items:center; }
        .controls-right .btn-add { background:#28a745; color:#fff; }
        .show-select { display:flex; align-items:center; gap:8px; color:#495057; }
        .btn { padding: 8px 14px; border: none; border-radius: 4px; cursor: pointer; text-decoration: none; display: inline-block; margin-right: 10px; font-size: 13px; }
        .btn-add { background: #28a745; color: white; }
        .btn-add:hover { background: #218838; }
        .btn-back { background: #6c757d; color: white; }
        .btn-back:hover { background: #5a6268; }
        .search-box { display: inline-flex; gap:8px; align-items:center; }
        .search-box input { padding: 8px; width: 300px; border: 1px solid #ddd; border-radius: 4px; }
        .search-box button { padding: 8px 12px; background: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer; }
        
        .table-container { background: white; border-radius: 4px; overflow: hidden; box-shadow: none; border:1px solid #e9ecef; }
        table { width: 100%; border-collapse: collapse; font-size: 14px; }
        th { background: #495057; color: white; padding: 12px 14px; text-align: left; font-weight: 400; font-size: 13px; }
        /* Make header links non-underlined and not bold for readability */
        .table-container th a { color: inherit; text-decoration: none; font-weight: 400; }
        .table-container th a:hover { text-decoration: underline; color: #e9eefc; }
        td { padding: 10px 14px; border-bottom: 1px solid #eef1f3; vertical-align: middle; }
        tbody tr:nth-child(odd) { background: #ffffff; }
        tr:hover { background: #fbfbfb; }
        
        .action-btn { padding: 4px 8px; border: none; border-radius: 3px; cursor: pointer; font-size: 12px; display: inline-block; }
        .btn-edit { background: #ffc107; color: white; }
        .btn-edit:hover { background: #e0a800; }
        .btn-delete { background: #dc3545; color: white; }
        .btn-delete:hover { background: #c82333; }
        
        /* Pagination: right-aligned, compact, rounded buttons */
        .pagination { display:flex; justify-content:flex-end; align-items:center; gap:10px; padding: 12px 8px; margin-top:12px; }
        .pagination a, .pagination span { padding: 6px 10px; margin: 0; text-decoration: none; color: #2166d6; font-size: 13px; border-radius: 8px; display:inline-flex; align-items:center; justify-content:center; min-width: 34px; height:34px; }
        .pagination a { background: #fff; border: 1px solid #e6eefc; box-shadow: 0 1px 0 rgba(34,60,80,0.02); transition: all .12s ease; }
        .pagination a:hover { background: #eaf4ff; color: #0b57d0; transform: translateY(-2px); }
        .pagination .active { background: #1976d2; color: white; border: none; box-shadow: 0 8px 18px rgba(25,118,210,0.18); font-weight:600; }
        .pagination .disabled { color: #bfc9d9; pointer-events: none; background: transparent; border: none; height:auto; min-width: unset; padding: 6px 10px; }
        .pagination .ellipsis { color:#9aa6bf; padding:6px 10px; background:transparent; border-radius:4px; min-width: unset; height:auto; }
        
        .info { background: white; padding: 12px 15px; border-radius: 5px; margin-bottom: 12px; }
        .info p { margin: 4px 0; font-size:14px; }
        .badge { display:inline-block; background:#e9ecef; color:#333; padding:4px 8px; border-radius:12px; font-size:12px; border:1px solid #ddd; }
        .stt-badge { display:inline-block; width:30px; height:30px; line-height:30px; text-align:center; background:#f8f9fa; border:1px solid #e9ecef; border-radius:50%; color:#495057; font-size:13px; }
        .class-badge { display:inline-block; background:#20a4b8; color:#fff; padding:6px 12px; border-radius:20px; font-size:12px; }
        .btn-add { background: #28a745; color: white; padding:8px 12px; border-radius:4px; }
        .btn-add:hover { background: #218838; }
        .btn-edit { background: #ffc107; color: #212529; padding:6px 10px; border-radius:4px; }
        .btn-delete { background: #dc3545; color: #fff; padding:6px 10px; border-radius:4px; }
    </style>
</head>
<body>

    <!-- header removed -->

    <div class="container">
        
        <!-- Tiêu đề và nút thêm -->
        <div class="title-row">
            <h2>Danh sách sinh viên <span class="count-badge"><?php echo $data['totalRecord'] ?? 0; ?></span></h2>
            <div class="controls-right">
                <a href="<?php echo $data['baseUrl']; ?>?url=sinhvien/create" class="btn btn-add">+ Thêm sinh viên</a>
            </div>
        </div>

        <!-- Search / Filter panel -->
        <div class="search-panel">
            <div class="filters">
                <form method="get" action="<?php echo $data['baseUrl']; ?>" style="display:flex; gap:10px; align-items:center;">
                    <input type="hidden" name="url" value="sinhvien/index">
                    <input type="text" name="search" placeholder="Tìm theo tên hoặc MSSV..." value="<?php echo htmlspecialchars($data['search'] ?? ''); ?>">
                    <select name="lop">
                        <option value="">-- Tất cả lớp --</option>
                        <?php if(!empty($data['classes'])) { foreach($data['classes'] as $c) { $lopVal = htmlspecialchars($c['ten_lop'] ?? $c); echo "<option value='".$lopVal."'" . ((isset($data['lop']) && $data['lop']==($c['ten_lop'] ?? $c))?' selected':'') . ">" . $lopVal . "</option>"; } } ?>
                    </select>
                    <button type="submit" class="btn-search">Tìm kiếm</button>
                    <a href="<?php echo $data['baseUrl']; ?>?url=sinhvien/index" class="btn-reset">Đặt lại</a>
                </form>
            </div>
            <div class="controls-right">
                <div class="show-select">Hiển thị:
                    <form method="get" action="<?php echo $data['baseUrl']; ?>" style="display:inline-block;">
                        <input type="hidden" name="url" value="sinhvien/index">
                        <input type="hidden" name="search" value="<?php echo htmlspecialchars($data['search'] ?? ''); ?>">
                        <input type="hidden" name="lop" value="<?php echo htmlspecialchars($data['lop'] ?? ''); ?>">
                        <input type="hidden" name="sort" value="<?php echo htmlspecialchars($data['sort'] ?? ''); ?>">
                        <input type="hidden" name="dir" value="<?php echo htmlspecialchars($data['dir'] ?? 'asc'); ?>">
                        <select name="limit" onchange="this.form.submit()">
                            <option value="5" <?php echo (isset($data['limit']) && $data['limit']==5)?'selected':''; ?>>5 / trang</option>
                            <option value="10" <?php echo (!isset($data['limit'])||$data['limit']==10)?'selected':''; ?>>10 / trang</option>
                            <option value="20" <?php echo (isset($data['limit']) && $data['limit']==20)?'selected':''; ?>>20 / trang</option>
                        </select>
                    </form>
                </div>
            </div>
        </div>

        <!-- Bảng danh sách -->
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th style="width: 50px;">STT</th>
                        <?php
                            $curSort = $data['sort'] ?? '';
                            $curDir = strtolower($data['dir'] ?? 'asc');
                            $toggle = function($col) use ($curSort, $curDir, $data) {
                                $dir = 'asc';
                                if ($curSort === $col) $dir = ($curDir === 'asc') ? 'desc' : 'asc';
                                $url = $data['baseUrl'] . '?url=sinhvien/index&page=1&search=' . urlencode($data['search'] ?? '') . '&lop=' . urlencode($data['lop'] ?? '') . '&limit=' . urlencode($data['limit'] ?? '10') . '&sort=' . $col . '&dir=' . $dir;
                                return $url;
                            };
                            $indicator = function($col) use ($curSort, $curDir) {
                                if ($curSort === $col) return $curDir === 'asc' ? ' ↑' : ' ↓';
                                return '';
                            };
                        ?>
                        <th><a href="<?php echo $toggle('mssv'); ?>">MSSV<?php echo $indicator('mssv'); ?></a></th>
                        <th><a href="<?php echo $toggle('hoten'); ?>">Họ và Tên<?php echo $indicator('hoten'); ?></a></th>
                        <th><a href="<?php echo $toggle('gioi_tinh'); ?>">Giới tính<?php echo $indicator('gioi_tinh'); ?></a></th>
                        <th><a href="<?php echo $toggle('lop'); ?>">Lớp<?php echo $indicator('lop'); ?></a></th>
                        <th style="width: 120px;">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if (!empty($data['students'])) {
                        $limitVal = isset($data['limit']) ? (int)$data['limit'] : 10;
                        $currentPage = isset($data['currentPage']) ? (int)$data['currentPage'] : 1;
                        $stt = (($currentPage - 1) * $limitVal) + 1;
                        foreach($data['students'] as $student) {
                            echo "<tr>";
                            echo "<td><span class='badge'>" . ($stt++) . "</span></td>";
                            echo "<td>" . htmlspecialchars($student['mssv']) . "</td>";
                            echo "<td>" . htmlspecialchars($student['hoten']) . "</td>";
                            echo "<td>" . htmlspecialchars($student['gioi_tinh'] ?? 'N/A') . "</td>";
                            echo "<td>" . (!empty($student['lop']) ? "<span class='class-badge'>" . htmlspecialchars($student['lop']) . "</span>" : "<span class='badge'>Chưa phân lớp</span>") . "</td>";
                            echo "<td>";
                            echo "<a href=\"" . $data['baseUrl'] . "?url=sinhvien/edit/" . $student['id'] . "\" class=\"action-btn btn-edit\">Sửa</a> ";
                            echo "<a href=\"" . $data['baseUrl'] . "?url=sinhvien/delete/" . $student['id'] . "\" class=\"action-btn btn-delete\" onclick=\"return confirm('Bạn chắc chắn muốn xóa?');\">Xóa</a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6' style='text-align: center; color: #999;'>Không có dữ liệu</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Phân trang -->
        <?php if ($data['totalPage'] > 1): ?>
        <div class="pagination">
            <!-- Nút Previous -->
            <?php if ($data['currentPage'] > 1): ?>
                <a href="<?php echo $data['baseUrl']; ?>?url=sinhvien/index&page=<?php echo $data['currentPage'] - 1; ?>&search=<?php echo urlencode($data['search'] ?? ''); ?>&lop=<?php echo urlencode($data['lop'] ?? ''); ?>&limit=<?php echo urlencode($data['limit'] ?? '10'); ?>&sort=<?php echo urlencode($data['sort'] ?? ''); ?>&dir=<?php echo urlencode($data['dir'] ?? 'asc'); ?>">← Trước</a>
            <?php else: ?>
                <span class="disabled">← Trước</span>
            <?php endif; ?>

            <!-- Các nút số trang -->
            <?php 
            $start = max(1, $data['currentPage'] - 2);
            $end = min($data['totalPage'], $data['currentPage'] + 2);
            
            if ($start > 1) {
                echo "<a href=\"" . $data['baseUrl'] . "?url=sinhvien/index&page=1&search=".urlencode($data['search'] ?? '')."&lop=".urlencode($data['lop'] ?? '')."&limit=".urlencode($data['limit'] ?? '10')."&sort=".urlencode($data['sort'] ?? '')."&dir=".urlencode($data['dir'] ?? 'asc')."\">1</a>";
                if ($start > 2) echo "<span class='ellipsis'>...</span>";
            }
            
            for ($i = $start; $i <= $end; $i++) {
                if ($i == $data['currentPage']) {
                    echo "<span class=\"active\">$i</span>";
                } else {
                    echo "<a href=\"" . $data['baseUrl'] . "?url=sinhvien/index&page=$i&search=".urlencode($data['search'] ?? '')."&lop=".urlencode($data['lop'] ?? '')."&limit=".urlencode($data['limit'] ?? '10')."&sort=".urlencode($data['sort'] ?? '')."&dir=".urlencode($data['dir'] ?? 'asc')."\">$i</a>";
                }
            }
            
            if ($end < $data['totalPage']) {
                if ($end < $data['totalPage'] - 1) echo "<span>...</span>";
                echo "<a href=\"" . $data['baseUrl'] . "?url=sinhvien/index&page=" . $data['totalPage'] . "&search=".urlencode($data['search'] ?? '')."&lop=".urlencode($data['lop'] ?? '')."&limit=".urlencode($data['limit'] ?? '10')."&sort=".urlencode($data['sort'] ?? '')."&dir=".urlencode($data['dir'] ?? 'asc')."\">" . $data['totalPage'] . "</a>";
            }
            ?>

            <!-- Nút Next -->
            <?php if ($data['currentPage'] < $data['totalPage']): ?>
                <a href="<?php echo $data['baseUrl']; ?>?url=sinhvien/index&page=<?php echo $data['currentPage'] + 1; ?>&search=<?php echo urlencode($data['search'] ?? ''); ?>&lop=<?php echo urlencode($data['lop'] ?? ''); ?>&limit=<?php echo urlencode($data['limit'] ?? '10'); ?>&sort=<?php echo urlencode($data['sort'] ?? ''); ?>&dir=<?php echo urlencode($data['dir'] ?? 'asc'); ?>">Sau →</a>
            <?php else: ?>
                <span class="disabled">Sau →</span>
            <?php endif; ?>
        </div>
        <?php endif; ?>

    </div>

</body>
</html>