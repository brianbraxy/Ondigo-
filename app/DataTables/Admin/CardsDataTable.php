<?php

namespace App\DataTables\Admin;

use App\Models\Card;
use Yajra\DataTables\Services\DataTable;
use Config, Auth, Common;
use Illuminate\Http\JsonResponse;

class CardsDataTable extends DataTable
{
    public function ajax(): JsonResponse
    {
        return datatables()
            ->eloquent($this->query())
            ->editColumn('UID', function ($card) {
                return isset($card->UID) ? $card->UID : '-';
            })
            ->editColumn('user', function ($card) {
                if(isset($card->user->id)){
                    return (Common::has_permission(auth('admin')->user()->id, 'edit_user')) ?
                    '<a href="' . url(config('adminPrefix') . '/users/edit/' . $card->user->id) . '">' . $card->user->first_name . ' ' . $card->user->last_name . '</a>' : $card->user->first_name;
                }
                return "";
            })
            ->addColumn('status', function ($card) {
                $status = '';

                if ($card->status == 0) {
                    $status = getStatusLabel("unlinked");
                } elseif ($card->status == 1) {
                    $status = getStatusLabel("linked");
                } elseif ($card->status == 2) {
                    $status = getStatusLabel("blocked");
                } else {
                    $status = $status;
                }

                return $status;
            })
            ->addColumn('action', function ($card) {
                $edit = (Common::has_permission(auth('admin')->user()->id, 'edit_card')) ? '<a href="' . url(config('adminPrefix') . '/cards/edit/' . $card->id) . '" class="btn btn-xs btn-primary"><i class="fa fa-edit f-14"></i></a>&nbsp;' : '';
                $delete = (Common::has_permission(auth('admin')->user()->id, 'delete_card')) ? '<a href="' . url(config('adminPrefix') . '/cards/delete/' . $card->id) . '" class="btn btn-xs btn-danger delete-warning"><i class="fa fa-trash"></i></a>' : '';
                return $edit . $delete;
                return "";
            })
            ->rawColumns(['UID', 'user', 'status', 'action'])
            ->make(true);
    }

    public function query()
    {
        $query = Card::with(['user:first_name,last_name'])->select('cards.*');
        return $this->applyScopes($query);
    }

    public function html()
    {
        return $this->builder()
            ->addColumn(['data' => 'id', 'name' => 'cards.id', 'title' => __('ID'), 'searchable' => false, 'visible' => false])
            ->addColumn(['data' => 'UID', 'name' => 'cards.UID', 'title' => __('UID')])
            ->addColumn(['data' => 'user', 'name' => 'users.first_name', 'title' => __('User')])
            ->addColumn(['data' => 'status', 'name' => 'users.status', 'title' => __('Status')])
            ->addColumn(['data' => 'action', 'name' => 'action', 'title' => __('Action'), 'orderable' => false, 'searchable' => false])
            ->parameters(dataTableOptions());
    }
}
