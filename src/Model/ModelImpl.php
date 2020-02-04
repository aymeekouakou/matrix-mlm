<?php


namespace MatrixMlm\Model;

interface ModelImpl
{
    public function sql(): string;
    public function install(): array;
    public function update(): array;
    public function remove(): array;
}