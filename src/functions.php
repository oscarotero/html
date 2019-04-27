<?php
declare(strict_types = 1);

namespace Html;

function array2Html(array $data): ElementInterface
{
    $fn = "Html\\{$data['tag']}";

    if (!function_exists($fn)) {
        throw new InvalidArgumentException(
            sprintf('Function %s does not exists', $fn)
        );
    }

    $args = [$data['attributes']];

    if (isset($data['children'])) {
        foreach ($data['children'] as $child) {
            if (is_array($child)) {
                $child = array2Html($child);
            }

            $args[] = $child;
        }
    }
    
    return $fn(...$args);
}
function html(...$args): ElementInterface
{
    return Element::create('html', $args);
}
function base(...$args): ElementInterface
{
    return SelfClosingElement::create('base', $args);
}
function head(...$args): ElementInterface
{
    return Element::create('head', $args);
}
function link(...$args): ElementInterface
{
    return SelfClosingElement::create('link', $args);
}
function meta(...$args): ElementInterface
{
    return SelfClosingElement::create('meta', $args);
}
function style(...$args): ElementInterface
{
    return Element::create('style', $args);
}
function title(...$args): ElementInterface
{
    return Element::create('title', $args);
}
function body(...$args): ElementInterface
{
    return Element::create('body', $args);
}
function address(...$args): ElementInterface
{
    return Element::create('address', $args);
}
function article(...$args): ElementInterface
{
    return Element::create('article', $args);
}
function aside(...$args): ElementInterface
{
    return Element::create('aside', $args);
}
function footer(...$args): ElementInterface
{
    return Element::create('footer', $args);
}
function header(...$args): ElementInterface
{
    return Element::create('header', $args);
}
function h1(...$args): ElementInterface
{
    return Element::create('h1', $args);
}
function h2(...$args): ElementInterface
{
    return Element::create('h2', $args);
}
function h3(...$args): ElementInterface
{
    return Element::create('h3', $args);
}
function h4(...$args): ElementInterface
{
    return Element::create('h4', $args);
}
function h5(...$args): ElementInterface
{
    return Element::create('h5', $args);
}
function h6(...$args): ElementInterface
{
    return Element::create('h6', $args);
}
function main(...$args): ElementInterface
{
    return Element::create('main', $args);
}
function nav(...$args): ElementInterface
{
    return Element::create('nav', $args);
}
function section(...$args): ElementInterface
{
    return Element::create('section', $args);
}
function blockquote(...$args): ElementInterface
{
    return Element::create('blockquote', $args);
}
function dd(...$args): ElementInterface
{
    return Element::create('dd', $args);
}
function div(...$args): ElementInterface
{
    return Element::create('div', $args);
}
function dl(...$args): ElementInterface
{
    return Element::create('dl', $args);
}
function dt(...$args): ElementInterface
{
    return Element::create('dt', $args);
}
function figcaption(...$args): ElementInterface
{
    return Element::create('figcaption', $args);
}
function figure(...$args): ElementInterface
{
    return Element::create('figure', $args);
}
function hr(...$args): ElementInterface
{
    return SelfClosingElement::create('hr', $args);
}
function li(...$args): ElementInterface
{
    return Element::create('li', $args);
}
function ol(...$args): ElementInterface
{
    return Element::create('ol', $args);
}
function p(...$args): ElementInterface
{
    return Element::create('p', $args);
}
function pre(...$args): ElementInterface
{
    return Element::create('pre', $args);
}
function ul(...$args): ElementInterface
{
    return Element::create('ul', $args);
}
function a(...$args): ElementInterface
{
    return Element::create('a', $args);
}
function abbr(...$args): ElementInterface
{
    return Element::create('abbr', $args);
}
function b(...$args): ElementInterface
{
    return Element::create('b', $args);
}
function bdi(...$args): ElementInterface
{
    return Element::create('bdi', $args);
}
function bdo(...$args): ElementInterface
{
    return Element::create('bdo', $args);
}
function br(...$args): ElementInterface
{
    return SelfClosingElement::create('br', $args);
}
function cite(...$args): ElementInterface
{
    return Element::create('cite', $args);
}
function code(...$args): ElementInterface
{
    return Element::create('code', $args);
}
function data(...$args): ElementInterface
{
    return Element::create('data', $args);
}
function dfn(...$args): ElementInterface
{
    return Element::create('dfn', $args);
}
function em(...$args): ElementInterface
{
    return Element::create('em', $args);
}
function i(...$args): ElementInterface
{
    return Element::create('i', $args);
}
function kbd(...$args): ElementInterface
{
    return Element::create('kbd', $args);
}
function mark(...$args): ElementInterface
{
    return Element::create('mark', $args);
}
function q(...$args): ElementInterface
{
    return Element::create('q', $args);
}
function rb(...$args): ElementInterface
{
    return Element::create('rb', $args);
}
function rp(...$args): ElementInterface
{
    return Element::create('rp', $args);
}
function rt(...$args): ElementInterface
{
    return Element::create('rt', $args);
}
function rtc(...$args): ElementInterface
{
    return Element::create('rtc', $args);
}
function ruby(...$args): ElementInterface
{
    return Element::create('ruby', $args);
}
function s(...$args): ElementInterface
{
    return Element::create('s', $args);
}
function samp(...$args): ElementInterface
{
    return Element::create('samp', $args);
}
function small(...$args): ElementInterface
{
    return Element::create('small', $args);
}
function span(...$args): ElementInterface
{
    return Element::create('span', $args);
}
function strong(...$args): ElementInterface
{
    return Element::create('strong', $args);
}
function sub(...$args): ElementInterface
{
    return Element::create('sub', $args);
}
function sup(...$args): ElementInterface
{
    return Element::create('sup', $args);
}
function time(...$args): ElementInterface
{
    return Element::create('time', $args);
}
function u(...$args): ElementInterface
{
    return Element::create('u', $args);
}
function variable(...$args): ElementInterface
{
    return Element::create('var', $args);
}
function wbr(...$args): ElementInterface
{
    return SelfClosingElement::create('wbr', $args);
}
function area(...$args): ElementInterface
{
    return Element::create('area', $args);
}
function audio(...$args): ElementInterface
{
    return Element::create('audio', $args);
}
function img(...$args): ElementInterface
{
    return SelfClosingElement::create('img', $args);
}
function map(...$args): ElementInterface
{
    return Element::create('map', $args);
}
function track(...$args): ElementInterface
{
    return Element::create('track', $args);
}
function video(...$args): ElementInterface
{
    return Element::create('video', $args);
}
function embed(...$args): ElementInterface
{
    return Element::create('embed', $args);
}
function iframe(...$args): ElementInterface
{
    return Element::create('iframe', $args);
}
function object(...$args): ElementInterface
{
    return Element::create('object', $args);
}
function param(...$args): ElementInterface
{
    return Element::create('param', $args);
}
function picture(...$args): ElementInterface
{
    return Element::create('picture', $args);
}
function source(...$args): ElementInterface
{
    return Element::create('source', $args);
}
function canvas(...$args): ElementInterface
{
    return Element::create('canvas', $args);
}
function noscript(...$args): ElementInterface
{
    return Element::create('noscript', $args);
}
function script(...$args): ElementInterface
{
    return Element::create('script', $args);
}
function del(...$args): ElementInterface
{
    return Element::create('del', $args);
}
function ins(...$args): ElementInterface
{
    return Element::create('ins', $args);
}
function caption(...$args): ElementInterface
{
    return Element::create('caption', $args);
}
function col(...$args): ElementInterface
{
    return Element::create('col', $args);
}
function colgroup(...$args): ElementInterface
{
    return Element::create('colgroup', $args);
}
function table(...$args): ElementInterface
{
    return Element::create('table', $args);
}
function tbody(...$args): ElementInterface
{
    return Element::create('tbody', $args);
}
function td(...$args): ElementInterface
{
    return Element::create('td', $args);
}
function tfoot(...$args): ElementInterface
{
    return Element::create('tfoot', $args);
}
function th(...$args): ElementInterface
{
    return Element::create('th', $args);
}
function thead(...$args): ElementInterface
{
    return Element::create('thead', $args);
}
function tr(...$args): ElementInterface
{
    return Element::create('tr', $args);
}
function button(...$args): ElementInterface
{
    return Element::create('button', $args);
}
function datalist(...$args): ElementInterface
{
    return Element::create('datalist', $args);
}
function fieldset(...$args): ElementInterface
{
    return Element::create('fieldset', $args);
}
function form(...$args): ElementInterface
{
    return Element::create('form', $args);
}
function input(...$args): ElementInterface
{
    return SelfClosingElement::create('input', $args);
}
function label(...$args): ElementInterface
{
    return Element::create('label', $args);
}
function legend(...$args): ElementInterface
{
    return Element::create('legend', $args);
}
function meter(...$args): ElementInterface
{
    return Element::create('meter', $args);
}
function optgroup(...$args): ElementInterface
{
    return Element::create('optgroup', $args);
}
function option(...$args): ElementInterface
{
    return Element::create('option', $args);
}
function output(...$args): ElementInterface
{
    return Element::create('output', $args);
}
function progress(...$args): ElementInterface
{
    return Element::create('progress', $args);
}
function select(...$args): ElementInterface
{
    return Element::create('select', $args);
}
function textarea(...$args): ElementInterface
{
    return Element::create('textarea', $args);
}
function details(...$args): ElementInterface
{
    return Element::create('details', $args);
}
function dialog(...$args): ElementInterface
{
    return Element::create('dialog', $args);
}
function summary(...$args): ElementInterface
{
    return Element::create('summary', $args);
}
function slot(...$args): ElementInterface
{
    return Element::create('slot', $args);
}
function template(...$args): ElementInterface
{
    return Element::create('template', $args);
}
