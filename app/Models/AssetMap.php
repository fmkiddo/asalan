<?php
namespace App\Models;


class AssetMap extends Assets {
    /**
     * {@inheritDoc}
     * @see \App\Models\Assets::asDataTableFormat()
     */
    public function asDataTableFormat(array $params): array {
        $output = array ();
        foreach ($params as $k => $row) {
            $i  = $k+1;
            $output[$k] = array (
                $this->generateFirstColumn ($i),
                $row['location']['name'],
                $row['sublocation']['name'],
                $row['qty'],
            );
        }
        return $output;
    }
    
}