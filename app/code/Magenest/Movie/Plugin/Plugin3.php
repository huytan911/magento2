<?php

namespace Magenest\Movie\Plugin;

class Plugin3 {

    public function beforeSetTitle(\Magenest\Blog\Controller\Index\Example $subject, $title) {
        echo "Before Plugin 3 <br>";
        $title = $title . 'Before 3 ';
        return [$title];
    }
    public function aroundSetTitle(\Magenest\Blog\Controller\Index\Example $subject, callable $proceed, $title) {
        echo "Around Plugin 3 First Half<br>";
        $result = $proceed($title);
        echo "Around Plugin 3 Second Half<br>";

        return $result;
    }
    public function afterSetTitle(\Magenest\Blog\Controller\Index\Example $subject, $result, $title) {
        echo "After Plugin 3 <br>";
        return $result . ' After 3';
    }
}
