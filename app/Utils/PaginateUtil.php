<?php

namespace App\Utils;

class PaginateUtil
{
    public function mapData(array $data): array
    {
        $result = [
            'items' => $data['data'],
            'meta' => (object) []
        ];

        $data = $this->unsetData($data);
        $data['exists_next_page'] = $data['current_page'] < $data['last_page'];
        $data['exists_prev_page'] = $data['current_page'] > 1;

        $result['meta'] = $data;

        return $result;
    }

    private function unsetData($data): array
    {
        $keysToUnset = ['data', 'first_page_url', 'last_page_url', 'links', 'next_page_url', 'prev_page_url', 'path'];

        foreach ($keysToUnset as $key) {
            unset($data[$key]);
        }

        return $data;
    }
}
