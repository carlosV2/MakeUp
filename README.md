# MakeUp

The templates for data formats.

[![License](https://poser.pugx.org/carlosv2/makeup/license)](https://packagist.org/packages/carlosv2/makeup)
[![Build Status](https://travis-ci.org/carlosV2/MakeUp.svg?branch=master)](https://travis-ci.org/carlosV2/MakeUp)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/ee464521-436e-4cce-860a-ad09cc243d1b/mini.png)](https://insight.sensiolabs.com/projects/ee464521-436e-4cce-860a-ad09cc243d1b)

## Why

It is easy to find amazing projects like [Twig](https://twig.symfony.com/) to render data
easily in HTML or text format but when you need to build an API that returns the data in
JSON or XML format you don't have many options:
- You can compose the objects in the controller at the cost of loosing reusability.
- You can build a layer of DTOs and factories at the cost of loosing maintainability.

This projects aims to fix both problems by providing a templating engine for pure data.

## Install

Open a command console, enter your project directory and execute the following command to download the latest stable
version of this project:

```bash
$ composer require carlosv2/makeup
```

This command requires you to have Composer installed globally, as explained in
the [installation chapter](https://getcomposer.org/doc/00-intro.md) of the Composer documentation.

## Documentation

You can find the documentation [here](https://github.com/carlosV2/MakeUp/blob/master/docs/how_to.md).
