<?php
namespace App\Models;


class AssetPicker extends Assets {
    
    /**
     * {@inheritDoc}
     * @see \App\Models\Assets::asDataTableFormat()
     */
    public function asDataTableFormat (array $params): array {
        $output = array ();
        foreach ($params as $k => $row) {
            $i  = $k+1;
            $uuid       = base64_encode ($row['uuid']);
            $output[$k] = array (
                $this->generateFirstColumn ($i, $uuid),
                "<span data-loadsource=\"code\">{$row['code']}</span>",
                "<span data-loadsource=\"name\">{$row['name']}</span>",
                "<span data-loadsource=\"sublocation\">{$row['sublocation']['name']}</span>",
                "<span data-loadsource=\"qty\">{$row['qty']}</span>",
            );
        }
        return $output;
    }
    
}