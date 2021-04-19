<?php

return

    [
        "Gender" => ["Nam", "Nữ", "Không xác định?"],
        "Marriage" => ["Chưa kết hôn", "Đã kết hôn"],
        "validate_Marriage"=>[0,1],
        "Experience" => [
            0 => "Không yêu cầu",
            1 => "Dưới 1 năm",
            2 => "Trên 1 năm",
            6 => "Trên 5 năm"
        ],
        "validate_Experience" => [0, 1, 2, 6],
        "Regency" => ["Nhân viên", "Trường Phòng", "Quản đốc", "Giám đốc", "Không nằm mục trên"],
        "Job_Level" => ["Nhân viên", "Trường Phòng", "Quản đốc", "Giám đốc"],
        "validate_Level" => [0, 1, 2, 3],
        "validate_Regency" => [0, 1, 2, 3, 4],
        "validate_Company_Size" => [0, 1, 2, 3, 4],
        "Company_Size" => ["1 người", "5-10 người", "50-100 người", "200 trở lên"],
        "Job_Type" => [
            1 => "Toàn thời gian",
            2 => "Bán thời gian",
            3 => "Thực tập",
            4 => "Làm từ xa"
        ],
        "validate_Job_Type" => [1, 2, 3, 4]
    ];
