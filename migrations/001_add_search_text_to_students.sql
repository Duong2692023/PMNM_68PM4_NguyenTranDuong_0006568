-- Migration: Thêm cột search_text (chuẩn hóa không dấu) vào bảng students
-- Thực thi trên MySQL (ví dụ dùng phpMyAdmin hoặc CLI):

ALTER TABLE students
  ADD COLUMN search_text VARCHAR(512) NULL AFTER lop;

-- Tạo chỉ mục để tăng tốc LIKE searches (sử dụng tiền tố nếu cần)
CREATE INDEX idx_search_text ON students (search_text(255));

-- Lưu ý: Bạn cũng có thể tạo FULLTEXT index nếu MySQL hỗ trợ và muốn tìm nâng cao:
-- ALTER TABLE students ADD FULLTEXT INDEX ft_search_text (search_text);
