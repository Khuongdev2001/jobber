<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Model\Contact;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ConfigController extends Controller
{
    public function indexContact()
    {
        return view("admin.config.contact.index");
    }

    public function getIndexContact()
    {
        $contacts = Contact::select(["Contact_ID", "Phone", "Type", "Is_Block", "Created_At"])->whereNull("Deleted_At")->get();
        return
            DataTables::of($contacts)
            ->editColumn("Check", function ($contact) {
                return
                    '<div class="form-check d-flex justify-content-center">
                    <input class="form-check-input" type="checkbox" data-id="' . $contact->Contact_ID . '">
                    </div>';
            })
            ->editColumn("Type", function ($contact) {
                $convert = [
                    1 => [
                        "class" => "bg-success",
                        "content" => "Miền Bắc"
                    ],
                    2 => [
                        "class" => "bg-warning",
                        "content" => "Miền Trung"
                    ],
                    3 => [
                        "class" => "bg-info",
                        "content" => "Miền Nam"
                    ]
                ];

                return
                    '<span class="badge ' . $convert[$contact->Type]["class"] . '">' . $convert[$contact->Type]["content"] . '</span>';
            })
            ->addColumn("action", function ($contact) {
                $convert = [
                    [
                        "class" => "btn-success-hero",
                        "icon" => '<i class="fas fa-eye-slash"></i>'
                    ],
                    [
                        "class" => "btn-warning-hero",
                        "icon" => '<i class="fas fa-eye"></i>'
                    ]
                ];
                return
                    ' <div class="box-option">
                <a href="' . route("admin.config.contact.block", ["id" => $contact->Contact_ID, "status" => $contact->Is_Block, "continue" => route("admin.config.contact")]) . '" class="btn-hero ' . $convert[$contact->Is_Block]["class"] . ' shadow" data-bs-toggle="tooltip" title="Cập nhật nghành">' . $convert[$contact->Is_Block]["icon"] . '</a>
                <a href="javascript:void(0)" data-url=' . route("admin.config.contact.delete", ["ids" => $contact->Contact_ID, "continue" => route("admin.config.contact")]) . ' class="btn-hero btn-danger-hero shadow btn-delete" data-bs-toggle="tooltip" title="Xóa nghành"><i class="fas fa-trash-alt"></i></a>
            </div>';
            })
            ->rawColumns(["action", "Check", "Type"])
            ->make(true);
    }

    public function blockContact($id, Request $request)
    {

        $message = ["Liên hệ này đã được hiện", "Liên hệ này đã ẩn"];
        Contact::find($id)->update(["Is_Block" => !$request->status]);
        return redirect($request->continue)->with("success", ["title" => "Thông báo", "message" => $message[!$request->status]]);
    }

    public function deleteContact(Request $request)
    {
        $ids = $request->ids;
        $numContact = 0;
        foreach (explode(",", $ids) as $id) {
            $numContact++;
            Contact::find($id)->update(["Deleted_At" => date("Y-m-d")]);
        };
        return redirect($request->continue)->with("success", ["title" => "Thông báo", "message" => "Đã xóa thành công {$numContact} liên hệ "]);
    }
}
