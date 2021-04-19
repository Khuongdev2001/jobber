<?php

return
    [
        "employer" => [
            "user" => [
                "active" => [
                    "subject" => "[JOBBER] Email xác thực thông tin tài khoản nhà tuyển dụng :Fullname"
                ],
                "forget" => [
                    "subject" => "[JOBBER] Email khôi phục tài khoản nhà tuyển dụng :Fullname"
                ]
            ],
            "job" => [
                "apply" => [
                    "subject" => "[JOBBER] Jobber thông báo kết quả ứng tuyển công việc :Job_Title của bạn",
                    "message" => [
                        1 => "Đâu tiền cảm ơn :Fullname đã cùng nhau phát triển Jobber. Chúc mừng :Fullname đã được nhà tuyển dụng chọn. Nhà tuyển dụng sẽ thông báo cho bạn ngay",
                        2 => "Đâu tiền cảm ơn :Fullname đã cùng nhau phát triển Jobber. Nhưng rất tiết yêu cầu ứng tuyển của bạn không được chấp nhận. Lý do chưa biết từ nhà tuyển dụng"
                    ]
                ]
            ]
        ],
        "candidate" => [
            "user" => [
                "active" => [
                    "subject" => "[JOBBER] Email xác thực thông tin tài khoản ứng viên :Fullname"
                ],
                "forget" => [
                    "subject" => "[JOBBER] Email khôi phục tài khoản ứng viên:Fullname"
                ]
            ],
            "job" => [
                "apply" => [
                    "subject" => "[JOBBER] Thông báo :Fullname đã ứng tuyển công việc mà bạn đăng"
                ]
            ]
        ]
    ];
