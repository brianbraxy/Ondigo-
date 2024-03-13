<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\CardsDataTable;
use App\Http\Controllers\Controller;
use App\Models\Card;
use Illuminate\Http\Request;

class CardController extends Controller
{
  function card_list(CardsDataTable $dataTable)
  {
    $data['menu']     = 'cards';
    return $dataTable->render("admin.cards.index", $data);
  }


  function create()
  {
    $data['menu'] = 'cards';

    return view('admin.cards.create', $data);
  }

  function store(Request $request)
  {
    $data = $request->all();
    $card = new Card();
    $card->UID = $data['UID'];
    $card->status = $data['status'];
    $card->save();

    return redirect('/admin/cards');
  }

  function edit($id) {
    $data['menu'] = 'cards';
    $data['cards'] = Card::find($id);

    return view('admin.cards.edit', $data);

  }

  function update(Request $request) {
    $data = $request->all();
    $card =Card::find($data['id']);
    $card->UID = $data['UID'];
    $card->status = $data['status'];
    $card->save();
    return redirect('/admin/cards');
  }
}
