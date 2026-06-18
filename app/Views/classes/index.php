<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title><?php echo $data['page_title']; ?></title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background-color: #f0f2f5; }
        .container { max-width: 1200px; margin: 0 auto; padding: 20px; }
        .title-row { display:flex; align-items:center; justify-content:space-between; margin-bottom:10px; }
        .title-row h2 { font-size:20px; color:#343a40; margin:0; font-weight:600; }
        .count-badge { background:#6c757d; color:#fff; padding:3px 8px; border-radius:6px; font-size:12px; margin-left:8px; }

        .search-panel { background: white; padding: 12px 16px; border-radius: 6px; margin-bottom: 16px; display:flex; align-items:center; justify-content:space-between; gap:12px; border:1px solid #e9ecef; }
        .filters { display:flex; gap:10px; align-items:center; }
        .filters form { display:flex; gap:10px; align-items:center; margin:0; }
        .filters input[type="text"], .filters select, .filters .btn-search, .filters .btn-reset, .filters a { height:40px; padding:6px 12px; border:1px solid #ced4da; border-radius:4px; font-size:14px; box-sizing: border-box; display:inline-flex; align-items:center; }
        .filters input[type="text"] { line-height:18px; width:360px; }
        .filters .btn-search { background:#007bff; color:#fff; border:none; padding:0 14px; justify-content:center; }
        .filters .btn-reset { background:#fff; color:#212529; border:1px solid #ced4da; padding:0 12px; justify-content:center; }
        .controls-right { display:flex; gap:12px; align-items:center; }
        .btn { padding: 8px 14px; border: none; border-radius: 4px; cursor: pointer; text-decoration: none; display: inline-block; margin-right: 10px; font-size: 13px; }
        .btn-add { background: #28a745; color: white; }
        .btn-add:hover { background: #218838; }
        .btn-back { background: #6c757d; color: white; }
        .btn-back:hover { background: #5a6268; }

        .table-container { background: white; border-radius: 4px; overflow: hidden; box-shadow: none; border:1px solid #e9ecef; }
        table { width: 100%; border-collapse: collapse; font-size: 14px; }
        th { background: #667eea; color: white; padding: 12px 14px; text-align: left; font-weight: 400; font-size: 13px; }
        /* Table header links: no underline, normal weight */
        .table-container th a { color: inherit; text-decoration: none; font-weight: 400; }
        .table-container th a:hover { text-decoration: underline; color: #eef6ff; }
        td { padding: 10px 14px; border-bottom: 1px solid #eef1f3; vertical-align: middle; }
        tbody tr:nth-child(odd) { background: #ffffff; }
        tr:hover { background: #fbfbfb; }

        .action-btn { padding: 6px 10px; border: none; border-radius: 4px; cursor: pointer; font-size: 12px; display: inline-block; }
        .btn-edit { background: #ffc107; color: #212529; }
        .btn-delete { background: #dc3545; color: #fff; }

        .pagination { display:flex; justify-content:flex-end; align-items:center; gap:10px; padding: 12px 8px; margin-top:12px; }
        .pagination a, .pagination span { padding: 6px 10px; margin: 0; text-decoration: none; color: #2166d6; font-size: 13px; border-radius: 8px; display:inline-flex; align-items:center; justify-content:center; min-width: 34px; height:34px; }
        .pagination a { background: #fff; border: 1px solid #e6eefc; }
        .pagination a:hover { background: #eaf4ff; color: #0b57d0; }
        .pagination .active { background: #1976d2; color: white; border: none; box-shadow: 0 8px 18px rgba(25,118,210,0.18); font-weight:600; }

        .info { background: white; padding: 12px 15px; border-radius: 5px; margin-bottom: 12px; }
        .info p { margin: 4px 0; font-size:14px; }
    </style>
</head>
<body>

    <div class="container">
        <div class="title-row">
            <h2><?php echo $data['page_title']; ?> <span class="count-badge"><?php echo $data['totalRecord'] ?? 0; ?></span></h2>
            <div class="controls-right">
                <a href="<?php echo $data['baseUrl']; ?>?url=classes/create" class="btn btn-add">+ Thêm lớp</a>
                <a href="<?php echo $data['baseUrl']; ?>?url=home/index" class="btn btn-back">← Quay lại</a>
            </div>
        </div>

        <div class="search-panel">
            <div class="filters">
                <form method="get" action="<?php echo $data['baseUrl']; ?>" style="display:flex; gap:10px; align-items:center;">
                    <input type="hidden" name="url" value="classes/index">
                    <input type="text" name="search" placeholder="Tìm theo mã lớp hoặc tên lớp..." value="<?php echo htmlspecialchars($data['search'] ?? ''); ?>">
                    <button type="submit" class="btn-search">Tìm</button>
                    <a href="<?php echo $data['baseUrl']; ?>?url=classes/index" class="btn-reset">Đặt lại</a>
                </form>
            </div>
            <div class="controls-right">
                <div class="show-select">Hiển thị:
                    <form method="get" action="<?php echo $data['baseUrl']; ?>" style="display:inline-block;">
                        <input type="hidden" name="url" value="classes/index">
                        <input type="hidden" name="search" value="<?php echo htmlspecialchars($data['search'] ?? ''); ?>">
                        <select name="limit" onchange="this.form.submit()">
                            <option value="5" <?php echo (isset($data['limit']) && $data['limit']==5)?'selected':''; ?>>5 / trang</option>
                            <option value="10" <?php echo (!isset($data['limit'])||$data['limit']==10)?'selected':''; ?>>10 / trang</option>
                            <option value="20" <?php echo (isset($data['limit']) && $data['limit']==20)?'selected':''; ?>>20 / trang</option>
                        </select>
                    </form>
                </div>
            </div>
        </div>

        <div class="info">
            <p><strong>Tổng số lớp:</strong> <?php echo $data['totalRecord'] ?? 0; ?></p>
            <p><strong>Trang:</strong> <?php echo $data['currentPage']; ?> / <?php echo $data['totalPage'] ?? 1; ?></p>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th style="width: 50px;">STT</th>
                        <th>Mã Lớp</th>
                        <th>Tên Lớp</th>
                        <th>Giáo viên chủ nhiệm</th>
                        <th style="width: 120px;">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if (!empty($data['classes'])) {
                        $limitVal = isset($data['limit']) ? (int)$data['limit'] : 10;
                        $currentPage = isset($data['currentPage']) ? (int)$data['currentPage'] : 1;
                        $stt = (($currentPage - 1) * $limitVal) + 1;
                        foreach($data['classes'] as $class) {
                            echo "<tr>";
                            echo "<td><span class='badge'>" . ($stt++) . "</span></td>";
                            echo "<td>" . htmlspecialchars($class['ma_lop']) . "</td>";
                            echo "<td>" . htmlspecialchars($class['ten_lop']) . "</td>";
                            echo "<td>" . htmlspecialchars($class['giao_vien_chu_nhiem'] ?? 'N/A') . "</td>";
                            echo "<td>";
                            echo "<a href=\"" . $data['baseUrl'] . "?url=classes/edit/" . $class['id'] . "\" class=\"action-btn btn-edit\">Sửa</a> ";
                            echo "<a href=\"" . $data['baseUrl'] . "?url=classes/delete/" . $class['id'] . "\" class=\"action-btn btn-delete\" onclick=\"return confirm('Bạn chắc chắn muốn xóa?');\">Xóa</a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5' style='text-align: center; color: #999;'>Không có dữ liệu</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <?php if ($data['totalPage'] > 1): ?>
        <div class="pagination">
            <?php if ($data['currentPage'] > 1): ?>
                <a href="<?php echo $data['baseUrl']; ?>?url=classes/index&page=<?php echo $data['currentPage'] - 1; ?>&search=<?php echo urlencode($data['search'] ?? ''); ?>&limit=<?php echo urlencode($data['limit'] ?? '10'); ?>">← Trước</a>
            <?php else: ?>
                <span class="disabled">← Trước</span>
            <?php endif; ?>

            <?php 
            $start = max(1, $data['currentPage'] - 2);
            $end = min($data['totalPage'], $data['currentPage'] + 2);
            if ($start > 1) {
                echo "<a href=\"" . $data['baseUrl'] . "?url=classes/index&page=1&search=".urlencode($data['search'] ?? '')."&limit=".urlencode($data['limit'] ?? '10')."\">1</a>";
                if ($start > 2) echo "<span class='ellipsis'>...</span>";
            }
            for ($i = $start; $i <= $end; $i++) {
                if ($i == $data['currentPage']) {
                    echo "<span class=\"active\">$i</span>";
                } else {
                    echo "<a href=\"" . $data['baseUrl'] . "?url=classes/index&page=$i&search=".urlencode($data['search'] ?? '')."&limit=".urlencode($data['limit'] ?? '10')."\">$i</a>";
                }
            }
            if ($end < $data['totalPage']) {
                if ($end < $data['totalPage'] - 1) echo "<span class='ellipsis'>...</span>";
                echo "<a href=\"" . $data['baseUrl'] . "?url=classes/index&page=" . $data['totalPage'] . "&search=".urlencode($data['search'] ?? '')."&limit=".urlencode($data['limit'] ?? '10')."\">" . $data['totalPage'] . "</a>";
            }
            ?>

            <?php if ($data['currentPage'] < $data['totalPage']): ?>
                <a href="<?php echo $data['baseUrl']; ?>?url=classes/index&page=<?php echo $data['currentPage'] + 1; ?>&search=<?php echo urlencode($data['search'] ?? ''); ?>&limit=<?php echo urlencode($data['limit'] ?? '10'); ?>">Sau →</a>
            <?php else: ?>
                <span class="disabled">Sau →</span>
            <?php endif; ?>
        </div>
        <?php endif; ?>

    </div>

</body>
</html>
