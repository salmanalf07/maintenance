<?php
function getIdTrouble($date, $id)
{
    $idTrouble = "TR" . date("y", strtotime($date)) . date("m", strtotime($date)) . sprintf('%04d', $id);

    return $idTrouble;
}
function getImage($type, $id)
{

    // Path lengkap ke file
    $imagePath = public_path("assets/uploads/$type/$id");

    // Cek apakah file ada di folder
    if (file_exists($imagePath)) {
        return response()->json([
            "status" => "success",
            "image_url" => asset("assets/uploads/$type/$id")
        ]);
    }

    // Jika file tidak ditemukan
    return response()->json(["status" => "error", "message" => "Image not found"], 404);
}
