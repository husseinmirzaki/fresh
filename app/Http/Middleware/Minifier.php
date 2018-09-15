<?php

namespace App\Http\Middleware;

use Closure;

class Minifier
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //wait for response
        $response = $next($request);

        //get try to get content type header
        $header = $response->headers;
        $content_type = $header->get('Content-Type');

        //if content type header is 'test/html'
        //then minify it !!
        if (is_numeric(strpos($content_type, 'text/html'))) {
            $minifyHTML = $this->minifyHTML($response->getContent());
            $response->setContent($minifyHTML);
        }

        return $response;
    }

    private function minifyHTML($htmlString)
    {
        $replace = [
            '<!--(.*?)-->' => '', //remove comments
            "/<\?php/"     => '<?php ',
            "/\n([\S])/"   => '$1',
            "/\r/"         => '', // remove carriage return
            "/\n/"         => '', // remove new lines
            "/\t/"         => '', // remove tab
            "/\s+/"        => ' ', // remove spaces
        ];
        return preg_replace(array_keys($replace), array_values($replace), $htmlString);
    }
}
