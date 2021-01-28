---
layout: default
title: Introducción
---

# Introducción

[![Autor](http://img.shields.io/badge/author-@alexbilbie-red.svg?style=flat-square)](https://twitter.com/alexbilbie)
[![Código Fuente](http://img.shields.io/badge/source-thephpleague%2Foauth2--server-blue.svg?style=flat-square)](https://github.com/thephpleague/oauth2-server)
[![Licencia del Software](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Estado de desarrollo](https://img.shields.io/travis/thephpleague/oauth2-server/master.svg?style=flat-square)](https://travis-ci.org/thephpleague/oauth2-server)
[![Total de descargas](https://img.shields.io/packagist/dt/league/oauth2-server.svg?style=flat-square)](https://packagist.org/packages/league/oauth2-server)

`league/oauth2-server` cumple con la implementación del estándar de [OAuth 2.0](https://tools.ietf.org/html/rfc6749) servidor de autorización escrito en PHP, lo que hace que trabajar con OAuth 2.0 sea trivial. Puedes configurar fácilmente un servidor OAuth 2.0 para proteger tu API con tokens de acceso, también puedes permitir a los clientes que te soliciten nuevos tokens de acceso y actualizarlos 
Actualmente tiene soporte para los siguientes tipos de conseciones.

* Conseción por código de autorización (Authorization code grant).
* Conseción implícita (Implicit grant).
* Conseción por credenciales del cliente (Client credentials grant).
* Conseción por credenciales de contraseña del propietario del recurso (Resource owner password credentials grant).
* Actualizaciones de conseción (Refresh grant).

Las siguientes RFCs (Solicitudes de comentarios, en inglés Request for Comments) son implementados:

* [RFC6749 "OAuth 2.0"](https://tools.ietf.org/html/rfc6749)
* [RFC6750 " The OAuth 2.0 Authorization Framework: Bearer Token Usage"](https://tools.ietf.org/html/rfc6750)
* [RFC7519 "JSON Web Token (JWT)"](https://tools.ietf.org/html/rfc7519)
* [RFC7636 "Proof Key for Code Exchange by OAuth Public Clients"](https://tools.ietf.org/html/rfc7636)

<!--
También puede crear fácilmente sus propias [Conseciones personalizadas (custom grants)]().
-->

Está librería es creada por Alex Bilbie. Búscalo en Twitter como [@alexbilbie](https://twitter.com/alexbilbie).

## Changelog

Por favor mira [project's changelog](https://github.com/thephpleague/oauth2-server/blob/master/CHANGELOG.md) el historial completo de los cambios y actualizaciones de está librería..

Lo más reciente [![GitHub tag](https://img.shields.io/github/tag/thephpleague/oauth2-server.svg)](https://github.com/thephpleague/oauth2-server/releases)

## Soporte

Preguntas y respuestas en [Github issues page](https://github.com/thephpleague/oauth2-server/issues).

For commercial support and custom implementations please visit [Glynde Labs](https://glyndelabs.com).
