<?php

namespace src;
class Tasks
{
    ##TASK 1
    public function transform($flat_array): array
    {
        $tree = [];
        $storeArray = [];

        foreach ($flat_array as $item) {
            $storeArray[$item['id']] = [
                'id' => $item['id'],
                'parent_id' => $item['parent_id'],
                'value' => $item['value'],
                'children' => []
            ];
        }

        foreach ($storeArray as $id => &$node) {
            if (!isset($node['parent_id'])) {
                $tree[] = &$node;
            } else {
                $parent_id = $node['parent_id'];
                if (isset($storeArray[$parent_id])) {
                    $storeArray[$parent_id]['children'][] = &$node;
                }
            }
        }

        return $tree;
    }

    ##TASK 2
    public function findMaxDepth($tree): int
    {
        if (empty($tree)) {
            return 0;
        }

        $max_depth = 0;
        foreach ($tree as $node) {
            $depth = $this->findMaxDepth($node['children']);
            if ($depth > $max_depth) {
                $max_depth = $depth;
            }
        }
        return ++$max_depth;
    }


    ##TASK 3
    public function findItemsByValue($tree, $value): array
    {
        $ids = [];

        function search_tree($node, $value, &$ids): void
        {
            if (isset($node['value']) && $node['value'] === $value) {
                $ids[] = $node['id'];
            }

            if (isset($node['children'])) {
                foreach ($node['children'] as $child) {
                    search_tree($child, $value, $ids);
                }
            }
        }

        foreach ($tree as $item) {
            search_tree($item, $value, $ids);
        }

        return $ids;
    }

    ##TASK 4
    public function findValueById($result_tree, $id) {
        foreach ($result_tree as $item) {
            if ($item['id'] === $id) {
                return $item['value'];
            }

            if (isset($item['children'])) {
                $found_value = $this->findValueById($item['children'], $id);
                if (isset($found_value)) {
                    return $found_value;
                }
            }
        }

        return null;
    }

    ##TASK 5
    public function removeItemById($tree, $id): array
    {
        $new_tree = [];

        foreach ($tree as $item) {
            // If the current item's id matches the given id, we skip it
            if ($item['id'] === $id) {
                continue;  // Skip this item and its children
            }

            // If the item has children, we recursively remove the item from the children
            if (isset($item['children'])) {
                $item['children'] = $this->removeItemById($item['children'], $id);
            }

            // Add the item to the new tree
            $new_tree[] = $item;
        }

        return $new_tree;
    }

    ##TASK6
    public function removeDuplicates($tree): array
    {
        $checked = [];
        function traverse_and_remove_duplicates($tree, &$checked): array
        {
            $filtered_tree = [];

            foreach ($tree as $item) {
                if (!isset($checked[$item['value']]) || $item['id'] < $checked[$item['value']]) {
                    $checked[$item['value']] = $item['id'];
                    if (isset($item['children'])) {
                        $item['children'] = traverse_and_remove_duplicates($item['children'], $checked);
                    }
                    $filtered_tree[] = $item;
                }
            }

            return $filtered_tree;
        }

        // Start the recursive process
        return traverse_and_remove_duplicates($tree, $checked);
    }
}