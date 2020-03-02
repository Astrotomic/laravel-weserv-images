# Changelog

All notable changes to `laravel-weserv-images` will be documented in this file

## 0.4.0 - 2020-03-02

- BC: change method signature of `toPicture(array $attr = [], array $srcSet = [])`
this was done to have the same signature as `toImg()` and allow all custom attributes

## 0.3.0 - 2020-03-01

- add `toPicture()` method

## 0.2.1 - 2020-02-29

- fix used `Url` class

## 0.2.0 - 2020-02-29

- implement several Laravel interfaces: `Htmlable`, `Renderable`, `Responsable`, `Jsonable`, `JsonSerializable`, `Arrayable`

## 0.1.0 - 2020-02-29

- initial release
