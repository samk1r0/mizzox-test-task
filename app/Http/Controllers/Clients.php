<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;

class Clients
{
    public function list() : Collection
    {
        $clients = Client::query();

        $clients->select(['name', 'surname']);

        return $clients->get();
    }

    public function get(string $id) : \App\Models\Client
    {
        $client = Client::with(['books'])
            ->where('id', $id)
            ->firstOrFail();
        return $client;
    }

    public function create(Request $request) : JsonResponse
    {
        $client = Client::create($request->all());

        return response()->json($client, 201);
    }

    public function delete(string $id) : JsonResponse
    {
        $client = Client::find($id);
        if (!$client) {
            return response()->json(['message' => 'Klient nie został znaleziony'], 404);
        }
        $client->delete();
        return response()->json(['message' => 'Client deleted successfully'], 200);
    }
}
