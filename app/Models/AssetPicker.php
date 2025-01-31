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
            $assetCode  = $row['asset_code'];
            $output[$k] = array (
                $this->generateFirstColumn (($k+1), $assetCode),
                "<span data-loadsource=\"code\">{$row['asset_code']}</span>",
                "<span data-loadsource=\"name\">{$row['asset_dscript']}</span>",
                "<span data-loadsource=\"sublocation\">{$row['asset_subloc']}</span>",
                "<span data-loadsource=\"qty\">{$row['asset_total']}</span>",
            );
        }
        return $output;
    }
    
}