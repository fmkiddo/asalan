<?php
namespace App\Models;


class AssetLocation extends Assets {
    
    /**
     * {@inheritDoc}
     * @see \App\Models\Assets::asDataTableFormat()
     */
    public function asDataTableFormat(array $params): array {
        $output = array ();
        foreach ($params as $k => $asset) {
            $i  = $k+1;
            $output[$k] = array (
                $this->generateFirstColumn ($i),
                $asset['code'],
                $asset['name'],
                $asset['config']['name'],
                $asset['sublocation']['name'],
                $asset['qty'],
            );
        }
        return $output;
    }
    
}