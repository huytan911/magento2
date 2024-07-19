<?php

namespace Magenest\Blog\Plugin;

class Plugin2 {

    public function beforeSetTitle(\Magenest\Blog\Controller\Index\Example $subject, $title) {
        echo "Before Plugin 2 <br>";
        $title = $title . 'Before 2 ';
        return [$title];
    }
    public function aroundSetTitle(\Magenest\Blog\Controller\Index\Example $subject, callable $proceed, $title) {
        echo "Around Plugin 2 First Half <br>";
        $result = $proceed($title);
        echo "Around Plugin 2 Second Half <br>";

        return $result;
    }
    public function afterSetTitle(\Magenest\Blog\Controller\Index\Example $subject, $result, $title) {
        echo "After Plugin 2 <br>";
        return $result . ' After 2';
    }

}
