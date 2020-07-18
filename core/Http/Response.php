<?php


namespace Core\Http;


class Response
{
    protected array $headers = [];
    protected int $status = 200;
    protected string $content = '';

    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * @param array $headers
     * @return Response
     */
    public function header(string $header, string $value): Response
    {
        $this->headers[$header] = $value;
        return $this;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param int $status
     * @return Response
     */
    public function status(int $status): Response
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     * @return Response
     */
    public function send(string $content): Response
    {
        $this->content = $content;
        return $this;
    }

}