<?php

namespace Magenest\Blog\Plugin;

class Plugin1 {

    public function beforeSetTitle(\Magenest\Blog\Controller\Index\Example $subject, $title) {
        echo "Before Plugin 1 <br>";
        $title = $title . ' Before 1 ';
        return [$title];
    }
    public function aroundSetTitle(\Magenest\Blog\Controller\Index\Example $subject, callable $proceed, $title) {
        echo "Around Plugin 1 First Half<br>";
        $result = $proceed($title);
        echo "Around Plugin 1 Second Half<br>";

        return $result;
    }
    public function afterSetTitle(\Magenest\Blog\Controller\Index\Example $subject, $result, $title) {
        echo "After Plugin 1 <br>";
        return $result . ' After 1';
    }

}
