<?php

namespace Tests\Feature\Services;

use App\Facades\QrCode;
use App\Services\QrCodeService;
use PHPUnit\Framework\Attributes\CoversClass;
use Tests\Classes\LocalFile;
use Tests\FeatureTestCase;

/**
 * QrCodeServiceTest test class
 */
#[CoversClass(QrCodeService::class)]
#[CoversClass(QrCode::class)]
class QrCodeServiceTest extends FeatureTestCase
{
    private const STRING_TO_ENCODE = 'stringToEncode';

    private const STRING_ENCODED = 'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiPz4NCjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiBjbGFzcz0icXItc3ZnIHFyY29kZSIgdmlld0JveD0iMCAwIDI1IDI1IiBwcmVzZXJ2ZUFzcGVjdFJhdGlvPSJ4TWlkWU1pZCI+DQo8cGF0aCBjbGFzcz0icXItZGF0YSBsaWdodCBxcmNvZGUiIGZpbGw9IiNmZmYiIGQ9Ik0xMiAyIGgxIHYxIGgtMVogTTEzIDIgaDEgdjEgaC0xWiBNMTIgMyBoMSB2MSBoLTFaIE0xMyAzIGgxIHYxIGgtMVogTTExIDQgaDEgdjEgaC0xWiBNMTMgNCBoMSB2MSBoLTFaIE0xMSA1IGgxIHYxIGgtMVogTTEyIDUgaDEgdjEgaC0xWiBNMTQgNSBoMSB2MSBoLTFaIE0xNCA2IGgxIHYxIGgtMVogTTExIDcgaDEgdjEgaC0xWiBNMTIgNyBoMSB2MSBoLTFaIE0xMyA3IGgxIHYxIGgtMVogTTE0IDcgaDEgdjEgaC0xWiBNMTMgOSBoMSB2MSBoLTFaIE0xNCA5IGgxIHYxIGgtMVogTTExIDEwIGgxIHYxIGgtMVogTTE0IDEwIGgxIHYxIGgtMVogTTIgMTEgaDEgdjEgaC0xWiBNMyAxMSBoMSB2MSBoLTFaIE01IDExIGgxIHYxIGgtMVogTTYgMTEgaDEgdjEgaC0xWiBNNyAxMSBoMSB2MSBoLTFaIE05IDExIGgxIHYxIGgtMVogTTEyIDExIGgxIHYxIGgtMVogTTEzIDExIGgxIHYxIGgtMVogTTE0IDExIGgxIHYxIGgtMVogTTMgMTIgaDEgdjEgaC0xWiBNNSAxMiBoMSB2MSBoLTFaIE02IDEyIGgxIHYxIGgtMVogTTkgMTIgaDEgdjEgaC0xWiBNMTEgMTIgaDEgdjEgaC0xWiBNMTMgMTIgaDEgdjEgaC0xWiBNMTQgMTIgaDEgdjEgaC0xWiBNMTYgMTIgaDEgdjEgaC0xWiBNMTggMTIgaDEgdjEgaC0xWiBNMjAgMTIgaDEgdjEgaC0xWiBNMyAxMyBoMSB2MSBoLTFaIE01IDEzIGgxIHYxIGgtMVogTTEwIDEzIGgxIHYxIGgtMVogTTExIDEzIGgxIHYxIGgtMVogTTEzIDEzIGgxIHYxIGgtMVogTTE0IDEzIGgxIHYxIGgtMVogTTE1IDEzIGgxIHYxIGgtMVogTTE2IDEzIGgxIHYxIGgtMVogTTE3IDEzIGgxIHYxIGgtMVogTTIwIDEzIGgxIHYxIGgtMVogTTIxIDEzIGgxIHYxIGgtMVogTTQgMTQgaDEgdjEgaC0xWiBNNyAxNCBoMSB2MSBoLTFaIE0xMiAxNCBoMSB2MSBoLTFaIE0xNSAxNCBoMSB2MSBoLTFaIE0xNiAxNCBoMSB2MSBoLTFaIE0xNyAxNCBoMSB2MSBoLTFaIE0xOCAxNCBoMSB2MSBoLTFaIE0yMCAxNCBoMSB2MSBoLTFaIE0yMSAxNCBoMSB2MSBoLTFaIE0yMiAxNCBoMSB2MSBoLTFaIE0xMSAxNSBoMSB2MSBoLTFaIE0xMiAxNSBoMSB2MSBoLTFaIE0xOCAxNSBoMSB2MSBoLTFaIE0yMCAxNSBoMSB2MSBoLTFaIE0yMiAxNSBoMSB2MSBoLTFaIE0xMSAxNiBoMSB2MSBoLTFaIE0xNCAxNiBoMSB2MSBoLTFaIE0xNSAxNiBoMSB2MSBoLTFaIE0xNiAxNiBoMSB2MSBoLTFaIE0xOSAxNiBoMSB2MSBoLTFaIE0yMSAxNiBoMSB2MSBoLTFaIE0yMiAxNiBoMSB2MSBoLTFaIE0xNCAxNyBoMSB2MSBoLTFaIE0xNiAxNyBoMSB2MSBoLTFaIE0xNyAxNyBoMSB2MSBoLTFaIE0yMSAxNyBoMSB2MSBoLTFaIE0xMyAxOCBoMSB2MSBoLTFaIE0xNSAxOCBoMSB2MSBoLTFaIE0xNiAxOCBoMSB2MSBoLTFaIE0xOCAxOCBoMSB2MSBoLTFaIE0yMiAxOCBoMSB2MSBoLTFaIE0xMSAxOSBoMSB2MSBoLTFaIE0xMiAxOSBoMSB2MSBoLTFaIE0xMyAxOSBoMSB2MSBoLTFaIE0xNSAxOSBoMSB2MSBoLTFaIE0xNyAxOSBoMSB2MSBoLTFaIE0xOCAxOSBoMSB2MSBoLTFaIE0xOSAxOSBoMSB2MSBoLTFaIE0yMiAxOSBoMSB2MSBoLTFaIE0xMSAyMCBoMSB2MSBoLTFaIE0xMiAyMCBoMSB2MSBoLTFaIE0xNSAyMCBoMSB2MSBoLTFaIE0xNyAyMCBoMSB2MSBoLTFaIE0xOCAyMCBoMSB2MSBoLTFaIE0yMSAyMCBoMSB2MSBoLTFaIE0yMiAyMCBoMSB2MSBoLTFaIE0xMyAyMSBoMSB2MSBoLTFaIE0xNyAyMSBoMSB2MSBoLTFaIE0xOSAyMSBoMSB2MSBoLTFaIE0yMCAyMSBoMSB2MSBoLTFaIE0yMSAyMSBoMSB2MSBoLTFaIE0xMSAyMiBoMSB2MSBoLTFaDQpNMTMgMjIgaDEgdjEgaC0xWiBNMTQgMjIgaDEgdjEgaC0xWiBNMTggMjIgaDEgdjEgaC0xWiBNMTkgMjIgaDEgdjEgaC0xWiBNMjEgMjIgaDEgdjEgaC0xWiBNMjIgMjIgaDEgdjEgaC0xWiIvPg0KPHBhdGggY2xhc3M9InFyLWZpbmRlciBsaWdodCBxcmNvZGUiIGZpbGw9IiNmZmYiIGQ9Ik0zIDMgaDEgdjEgaC0xWiBNNCAzIGgxIHYxIGgtMVogTTUgMyBoMSB2MSBoLTFaIE02IDMgaDEgdjEgaC0xWiBNNyAzIGgxIHYxIGgtMVogTTE3IDMgaDEgdjEgaC0xWiBNMTggMyBoMSB2MSBoLTFaIE0xOSAzIGgxIHYxIGgtMVogTTIwIDMgaDEgdjEgaC0xWiBNMjEgMyBoMSB2MSBoLTFaIE0zIDQgaDEgdjEgaC0xWiBNNyA0IGgxIHYxIGgtMVogTTE3IDQgaDEgdjEgaC0xWiBNMjEgNCBoMSB2MSBoLTFaIE0zIDUgaDEgdjEgaC0xWiBNNyA1IGgxIHYxIGgtMVogTTE3IDUgaDEgdjEgaC0xWiBNMjEgNSBoMSB2MSBoLTFaIE0zIDYgaDEgdjEgaC0xWiBNNyA2IGgxIHYxIGgtMVogTTE3IDYgaDEgdjEgaC0xWiBNMjEgNiBoMSB2MSBoLTFaIE0zIDcgaDEgdjEgaC0xWiBNNCA3IGgxIHYxIGgtMVogTTUgNyBoMSB2MSBoLTFaIE02IDcgaDEgdjEgaC0xWiBNNyA3IGgxIHYxIGgtMVogTTE3IDcgaDEgdjEgaC0xWiBNMTggNyBoMSB2MSBoLTFaIE0xOSA3IGgxIHYxIGgtMVogTTIwIDcgaDEgdjEgaC0xWiBNMjEgNyBoMSB2MSBoLTFaIE0zIDE3IGgxIHYxIGgtMVogTTQgMTcgaDEgdjEgaC0xWiBNNSAxNyBoMSB2MSBoLTFaIE02IDE3IGgxIHYxIGgtMVogTTcgMTcgaDEgdjEgaC0xWiBNMyAxOCBoMSB2MSBoLTFaIE03IDE4IGgxIHYxIGgtMVogTTMgMTkgaDEgdjEgaC0xWiBNNyAxOSBoMSB2MSBoLTFaIE0zIDIwIGgxIHYxIGgtMVogTTcgMjAgaDEgdjEgaC0xWiBNMyAyMSBoMSB2MSBoLTFaIE00IDIxIGgxIHYxIGgtMVogTTUgMjEgaDEgdjEgaC0xWiBNNiAyMSBoMSB2MSBoLTFaIE03IDIxIGgxIHYxIGgtMVoiLz4NCjxwYXRoIGNsYXNzPSJxci1zZXBhcmF0b3IgbGlnaHQgcXJjb2RlIiBmaWxsPSIjZmZmIiBkPSJNOSAyIGgxIHYxIGgtMVogTTE1IDIgaDEgdjEgaC0xWiBNOSAzIGgxIHYxIGgtMVogTTE1IDMgaDEgdjEgaC0xWiBNOSA0IGgxIHYxIGgtMVogTTE1IDQgaDEgdjEgaC0xWiBNOSA1IGgxIHYxIGgtMVogTTE1IDUgaDEgdjEgaC0xWiBNOSA2IGgxIHYxIGgtMVogTTE1IDYgaDEgdjEgaC0xWiBNOSA3IGgxIHYxIGgtMVogTTE1IDcgaDEgdjEgaC0xWiBNOSA4IGgxIHYxIGgtMVogTTE1IDggaDEgdjEgaC0xWiBNMiA5IGgxIHYxIGgtMVogTTMgOSBoMSB2MSBoLTFaIE00IDkgaDEgdjEgaC0xWiBNNSA5IGgxIHYxIGgtMVogTTYgOSBoMSB2MSBoLTFaIE03IDkgaDEgdjEgaC0xWiBNOCA5IGgxIHYxIGgtMVogTTkgOSBoMSB2MSBoLTFaIE0xNSA5IGgxIHYxIGgtMVogTTE2IDkgaDEgdjEgaC0xWiBNMTcgOSBoMSB2MSBoLTFaIE0xOCA5IGgxIHYxIGgtMVogTTE5IDkgaDEgdjEgaC0xWiBNMjAgOSBoMSB2MSBoLTFaIE0yMSA5IGgxIHYxIGgtMVogTTIyIDkgaDEgdjEgaC0xWiBNMiAxNSBoMSB2MSBoLTFaIE0zIDE1IGgxIHYxIGgtMVogTTQgMTUgaDEgdjEgaC0xWiBNNSAxNSBoMSB2MSBoLTFaIE02IDE1IGgxIHYxIGgtMVogTTcgMTUgaDEgdjEgaC0xWiBNOCAxNSBoMSB2MSBoLTFaIE05IDE1IGgxIHYxIGgtMVogTTkgMTYgaDEgdjEgaC0xWiBNOSAxNyBoMSB2MSBoLTFaIE05IDE4IGgxIHYxIGgtMVogTTkgMTkgaDEgdjEgaC0xWiBNOSAyMCBoMSB2MSBoLTFaIE05IDIxIGgxIHYxIGgtMVogTTkgMjIgaDEgdjEgaC0xWiIvPg0KPHBhdGggY2xhc3M9InFyLXRpbWluZyBsaWdodCBxcmNvZGUiIGZpbGw9IiNmZmYiIGQ9Ik0xMSA4IGgxIHYxIGgtMVogTTEzIDggaDEgdjEgaC0xWiBNOCAxMSBoMSB2MSBoLTFaIE04IDEzIGgxIHYxIGgtMVoiLz4NCjxwYXRoIGNsYXNzPSJxci1mb3JtYXQgbGlnaHQgcXJjb2RlIiBmaWxsPSIjZmZmIiBkPSJNMTAgMyBoMSB2MSBoLTFaIE0xMCA3IGgxIHYxIGgtMVogTTEwIDkgaDEgdjEgaC0xWiBNNiAxMCBoMSB2MSBoLTFaIE03IDEwIGgxIHYxIGgtMVogTTkgMTAgaDEgdjEgaC0xWiBNMTYgMTAgaDEgdjEgaC0xWiBNMTcgMTAgaDEgdjEgaC0xWiBNMjEgMTAgaDEgdjEgaC0xWiBNMTAgMTYgaDEgdjEgaC0xWiBNMTAgMTcgaDEgdjEgaC0xWiBNMTAgMTggaDEgdjEgaC0xWiIvPg0KPHBhdGggY2xhc3M9InFyLXF1aWV0em9uZSBsaWdodCBxcmNvZGUiIGZpbGw9IiNmZmYiIGQ9Ik0wIDAgaDEgdjEgaC0xWiBNMSAwIGgxIHYxIGgtMVogTTIgMCBoMSB2MSBoLTFaIE0zIDAgaDEgdjEgaC0xWiBNNCAwIGgxIHYxIGgtMVogTTUgMCBoMSB2MSBoLTFaIE02IDAgaDEgdjEgaC0xWiBNNyAwIGgxIHYxIGgtMVogTTggMCBoMSB2MSBoLTFaIE05IDAgaDEgdjEgaC0xWiBNMTAgMCBoMSB2MSBoLTFaIE0xMSAwIGgxIHYxIGgtMVogTTEyIDAgaDEgdjEgaC0xWiBNMTMgMCBoMSB2MSBoLTFaIE0xNCAwIGgxIHYxIGgtMVogTTE1IDAgaDEgdjEgaC0xWiBNMTYgMCBoMSB2MSBoLTFaIE0xNyAwIGgxIHYxIGgtMVogTTE4IDAgaDEgdjEgaC0xWiBNMTkgMCBoMSB2MSBoLTFaIE0yMCAwIGgxIHYxIGgtMVogTTIxIDAgaDEgdjEgaC0xWiBNMjIgMCBoMSB2MSBoLTFaIE0yMyAwIGgxIHYxIGgtMVogTTI0IDAgaDEgdjEgaC0xWiBNMCAxIGgxIHYxIGgtMVogTTEgMSBoMSB2MSBoLTFaIE0yIDEgaDEgdjEgaC0xWiBNMyAxIGgxIHYxIGgtMVogTTQgMSBoMSB2MSBoLTFaIE01IDEgaDEgdjEgaC0xWiBNNiAxIGgxIHYxIGgtMVogTTcgMSBoMSB2MSBoLTFaIE04IDEgaDEgdjEgaC0xWiBNOSAxIGgxIHYxIGgtMVogTTEwIDEgaDEgdjEgaC0xWiBNMTEgMSBoMSB2MSBoLTFaIE0xMiAxIGgxIHYxIGgtMVogTTEzIDEgaDEgdjEgaC0xWiBNMTQgMSBoMSB2MSBoLTFaIE0xNSAxIGgxIHYxIGgtMVogTTE2IDEgaDEgdjEgaC0xWiBNMTcgMSBoMSB2MSBoLTFaIE0xOCAxIGgxIHYxIGgtMVogTTE5IDEgaDEgdjEgaC0xWiBNMjAgMSBoMSB2MSBoLTFaIE0yMSAxIGgxIHYxIGgtMVogTTIyIDEgaDEgdjEgaC0xWiBNMjMgMSBoMSB2MSBoLTFaIE0yNCAxIGgxIHYxIGgtMVogTTAgMiBoMSB2MSBoLTFaIE0xIDIgaDEgdjEgaC0xWiBNMjMgMiBoMSB2MSBoLTFaIE0yNCAyIGgxIHYxIGgtMVogTTAgMyBoMSB2MSBoLTFaIE0xIDMgaDEgdjEgaC0xWiBNMjMgMyBoMSB2MSBoLTFaIE0yNCAzIGgxIHYxIGgtMVogTTAgNCBoMSB2MSBoLTFaIE0xIDQgaDEgdjEgaC0xWiBNMjMgNCBoMSB2MSBoLTFaIE0yNCA0IGgxIHYxIGgtMVogTTAgNSBoMSB2MSBoLTFaIE0xIDUgaDEgdjEgaC0xWiBNMjMgNSBoMSB2MSBoLTFaIE0yNCA1IGgxIHYxIGgtMVogTTAgNiBoMSB2MSBoLTFaIE0xIDYgaDEgdjEgaC0xWiBNMjMgNiBoMSB2MSBoLTFaIE0yNCA2IGgxIHYxIGgtMVogTTAgNyBoMSB2MSBoLTFaIE0xIDcgaDEgdjEgaC0xWiBNMjMgNyBoMSB2MSBoLTFaIE0yNCA3IGgxIHYxIGgtMVogTTAgOCBoMSB2MSBoLTFaIE0xIDggaDEgdjEgaC0xWiBNMjMgOCBoMSB2MSBoLTFaIE0yNCA4IGgxIHYxIGgtMVogTTAgOSBoMSB2MSBoLTFaIE0xIDkgaDEgdjEgaC0xWiBNMjMgOSBoMSB2MSBoLTFaIE0yNCA5IGgxIHYxIGgtMVogTTAgMTAgaDEgdjEgaC0xWiBNMSAxMCBoMSB2MSBoLTFaIE0yMyAxMCBoMSB2MSBoLTFaIE0yNCAxMCBoMSB2MSBoLTFaIE0wIDExIGgxIHYxIGgtMVogTTEgMTEgaDEgdjEgaC0xWiBNMjMgMTEgaDEgdjEgaC0xWiBNMjQgMTEgaDEgdjEgaC0xWiBNMCAxMiBoMSB2MSBoLTFaIE0xIDEyIGgxIHYxIGgtMVogTTIzIDEyIGgxIHYxIGgtMVogTTI0IDEyIGgxIHYxIGgtMVogTTAgMTMgaDEgdjEgaC0xWiBNMSAxMyBoMSB2MSBoLTFaIE0yMyAxMyBoMSB2MSBoLTFaIE0yNCAxMyBoMSB2MSBoLTFaIE0wIDE0IGgxIHYxIGgtMVogTTEgMTQgaDEgdjEgaC0xWg0KTTIzIDE0IGgxIHYxIGgtMVogTTI0IDE0IGgxIHYxIGgtMVogTTAgMTUgaDEgdjEgaC0xWiBNMSAxNSBoMSB2MSBoLTFaIE0yMyAxNSBoMSB2MSBoLTFaIE0yNCAxNSBoMSB2MSBoLTFaIE0wIDE2IGgxIHYxIGgtMVogTTEgMTYgaDEgdjEgaC0xWiBNMjMgMTYgaDEgdjEgaC0xWiBNMjQgMTYgaDEgdjEgaC0xWiBNMCAxNyBoMSB2MSBoLTFaIE0xIDE3IGgxIHYxIGgtMVogTTIzIDE3IGgxIHYxIGgtMVogTTI0IDE3IGgxIHYxIGgtMVogTTAgMTggaDEgdjEgaC0xWiBNMSAxOCBoMSB2MSBoLTFaIE0yMyAxOCBoMSB2MSBoLTFaIE0yNCAxOCBoMSB2MSBoLTFaIE0wIDE5IGgxIHYxIGgtMVogTTEgMTkgaDEgdjEgaC0xWiBNMjMgMTkgaDEgdjEgaC0xWiBNMjQgMTkgaDEgdjEgaC0xWiBNMCAyMCBoMSB2MSBoLTFaIE0xIDIwIGgxIHYxIGgtMVogTTIzIDIwIGgxIHYxIGgtMVogTTI0IDIwIGgxIHYxIGgtMVogTTAgMjEgaDEgdjEgaC0xWiBNMSAyMSBoMSB2MSBoLTFaIE0yMyAyMSBoMSB2MSBoLTFaIE0yNCAyMSBoMSB2MSBoLTFaIE0wIDIyIGgxIHYxIGgtMVogTTEgMjIgaDEgdjEgaC0xWiBNMjMgMjIgaDEgdjEgaC0xWiBNMjQgMjIgaDEgdjEgaC0xWiBNMCAyMyBoMSB2MSBoLTFaIE0xIDIzIGgxIHYxIGgtMVogTTIgMjMgaDEgdjEgaC0xWiBNMyAyMyBoMSB2MSBoLTFaIE00IDIzIGgxIHYxIGgtMVogTTUgMjMgaDEgdjEgaC0xWiBNNiAyMyBoMSB2MSBoLTFaIE03IDIzIGgxIHYxIGgtMVogTTggMjMgaDEgdjEgaC0xWiBNOSAyMyBoMSB2MSBoLTFaIE0xMCAyMyBoMSB2MSBoLTFaIE0xMSAyMyBoMSB2MSBoLTFaIE0xMiAyMyBoMSB2MSBoLTFaIE0xMyAyMyBoMSB2MSBoLTFaIE0xNCAyMyBoMSB2MSBoLTFaIE0xNSAyMyBoMSB2MSBoLTFaIE0xNiAyMyBoMSB2MSBoLTFaIE0xNyAyMyBoMSB2MSBoLTFaIE0xOCAyMyBoMSB2MSBoLTFaIE0xOSAyMyBoMSB2MSBoLTFaIE0yMCAyMyBoMSB2MSBoLTFaIE0yMSAyMyBoMSB2MSBoLTFaIE0yMiAyMyBoMSB2MSBoLTFaIE0yMyAyMyBoMSB2MSBoLTFaIE0yNCAyMyBoMSB2MSBoLTFaIE0wIDI0IGgxIHYxIGgtMVogTTEgMjQgaDEgdjEgaC0xWiBNMiAyNCBoMSB2MSBoLTFaIE0zIDI0IGgxIHYxIGgtMVogTTQgMjQgaDEgdjEgaC0xWiBNNSAyNCBoMSB2MSBoLTFaIE02IDI0IGgxIHYxIGgtMVogTTcgMjQgaDEgdjEgaC0xWiBNOCAyNCBoMSB2MSBoLTFaIE05IDI0IGgxIHYxIGgtMVogTTEwIDI0IGgxIHYxIGgtMVogTTExIDI0IGgxIHYxIGgtMVogTTEyIDI0IGgxIHYxIGgtMVogTTEzIDI0IGgxIHYxIGgtMVogTTE0IDI0IGgxIHYxIGgtMVogTTE1IDI0IGgxIHYxIGgtMVogTTE2IDI0IGgxIHYxIGgtMVogTTE3IDI0IGgxIHYxIGgtMVogTTE4IDI0IGgxIHYxIGgtMVogTTE5IDI0IGgxIHYxIGgtMVogTTIwIDI0IGgxIHYxIGgtMVogTTIxIDI0IGgxIHYxIGgtMVogTTIyIDI0IGgxIHYxIGgtMVogTTIzIDI0IGgxIHYxIGgtMVogTTI0IDI0IGgxIHYxIGgtMVoiLz4NCjxwYXRoIGNsYXNzPSJxci1kYXJrbW9kdWxlIGRhcmsgcXJjb2RlIiBmaWxsPSIjMDAwIiBkPSJNMTAgMTUgaDEgdjEgaC0xWiIvPg0KPHBhdGggY2xhc3M9InFyLWRhdGEtZGFyayBkYXJrIHFyY29kZSIgZmlsbD0iIzAwMCIgZD0iTTExIDIgaDEgdjEgaC0xWiBNMTQgMiBoMSB2MSBoLTFaIE0xMSAzIGgxIHYxIGgtMVogTTE0IDMgaDEgdjEgaC0xWiBNMTIgNCBoMSB2MSBoLTFaIE0xNCA0IGgxIHYxIGgtMVogTTEzIDUgaDEgdjEgaC0xWiBNMTEgNiBoMSB2MSBoLTFaIE0xMiA2IGgxIHYxIGgtMVogTTEzIDYgaDEgdjEgaC0xWiBNMTEgOSBoMSB2MSBoLTFaIE0xMiA5IGgxIHYxIGgtMVogTTEyIDEwIGgxIHYxIGgtMVogTTEzIDEwIGgxIHYxIGgtMVogTTQgMTEgaDEgdjEgaC0xWiBNMTAgMTEgaDEgdjEgaC0xWiBNMTEgMTEgaDEgdjEgaC0xWiBNMTUgMTEgaDEgdjEgaC0xWiBNMTYgMTEgaDEgdjEgaC0xWiBNMTcgMTEgaDEgdjEgaC0xWiBNMTggMTEgaDEgdjEgaC0xWiBNMTkgMTEgaDEgdjEgaC0xWiBNMjAgMTEgaDEgdjEgaC0xWiBNMjEgMTEgaDEgdjEgaC0xWiBNMjIgMTEgaDEgdjEgaC0xWiBNMiAxMiBoMSB2MSBoLTFaIE00IDEyIGgxIHYxIGgtMVogTTcgMTIgaDEgdjEgaC0xWiBNMTAgMTIgaDEgdjEgaC0xWiBNMTIgMTIgaDEgdjEgaC0xWiBNMTUgMTIgaDEgdjEgaC0xWiBNMTcgMTIgaDEgdjEgaC0xWiBNMTkgMTIgaDEgdjEgaC0xWiBNMjEgMTIgaDEgdjEgaC0xWiBNMjIgMTIgaDEgdjEgaC0xWiBNMiAxMyBoMSB2MSBoLTFaIE00IDEzIGgxIHYxIGgtMVogTTYgMTMgaDEgdjEgaC0xWiBNNyAxMyBoMSB2MSBoLTFaIE05IDEzIGgxIHYxIGgtMVogTTEyIDEzIGgxIHYxIGgtMVogTTE4IDEzIGgxIHYxIGgtMVogTTE5IDEzIGgxIHYxIGgtMVogTTIyIDEzIGgxIHYxIGgtMVogTTIgMTQgaDEgdjEgaC0xWiBNMyAxNCBoMSB2MSBoLTFaIE01IDE0IGgxIHYxIGgtMVogTTYgMTQgaDEgdjEgaC0xWiBNOSAxNCBoMSB2MSBoLTFaIE0xMCAxNCBoMSB2MSBoLTFaIE0xMSAxNCBoMSB2MSBoLTFaIE0xMyAxNCBoMSB2MSBoLTFaIE0xNCAxNCBoMSB2MSBoLTFaIE0xOSAxNCBoMSB2MSBoLTFaIE0xMyAxNSBoMSB2MSBoLTFaIE0xNCAxNSBoMSB2MSBoLTFaIE0xNSAxNSBoMSB2MSBoLTFaIE0xNiAxNSBoMSB2MSBoLTFaIE0xNyAxNSBoMSB2MSBoLTFaIE0xOSAxNSBoMSB2MSBoLTFaIE0yMSAxNSBoMSB2MSBoLTFaIE0xMiAxNiBoMSB2MSBoLTFaIE0xMyAxNiBoMSB2MSBoLTFaIE0xNyAxNiBoMSB2MSBoLTFaIE0xOCAxNiBoMSB2MSBoLTFaIE0yMCAxNiBoMSB2MSBoLTFaIE0xMSAxNyBoMSB2MSBoLTFaIE0xMiAxNyBoMSB2MSBoLTFaIE0xMyAxNyBoMSB2MSBoLTFaIE0xNSAxNyBoMSB2MSBoLTFaIE0xOCAxNyBoMSB2MSBoLTFaIE0xOSAxNyBoMSB2MSBoLTFaIE0yMCAxNyBoMSB2MSBoLTFaIE0yMiAxNyBoMSB2MSBoLTFaIE0xMSAxOCBoMSB2MSBoLTFaIE0xMiAxOCBoMSB2MSBoLTFaIE0xNCAxOCBoMSB2MSBoLTFaIE0xNyAxOCBoMSB2MSBoLTFaIE0xOSAxOCBoMSB2MSBoLTFaIE0yMCAxOCBoMSB2MSBoLTFaIE0yMSAxOCBoMSB2MSBoLTFaIE0xNCAxOSBoMSB2MSBoLTFaIE0xNiAxOSBoMSB2MSBoLTFaIE0yMCAxOSBoMSB2MSBoLTFaIE0yMSAxOSBoMSB2MSBoLTFaIE0xMyAyMCBoMSB2MSBoLTFaIE0xNCAyMCBoMSB2MSBoLTFaIE0xNiAyMCBoMSB2MSBoLTFaIE0xOSAyMCBoMSB2MSBoLTFaIE0yMCAyMCBoMSB2MSBoLTFaIE0xMSAyMSBoMSB2MSBoLTFaIE0xMiAyMSBoMSB2MSBoLTFaIE0xNCAyMSBoMSB2MSBoLTFaIE0xNSAyMSBoMSB2MSBoLTFaIE0xNiAyMSBoMSB2MSBoLTFaIE0xOCAyMSBoMSB2MSBoLTFaIE0yMiAyMSBoMSB2MSBoLTFaIE0xMiAyMiBoMSB2MSBoLTFaIE0xNSAyMiBoMSB2MSBoLTFaIE0xNiAyMiBoMSB2MSBoLTFaDQpNMTcgMjIgaDEgdjEgaC0xWiBNMjAgMjIgaDEgdjEgaC0xWiIvPg0KPHBhdGggY2xhc3M9InFyLWZpbmRlci1kYXJrIGRhcmsgcXJjb2RlIiBmaWxsPSIjMDAwIiBkPSJNMiAyIGgxIHYxIGgtMVogTTMgMiBoMSB2MSBoLTFaIE00IDIgaDEgdjEgaC0xWiBNNSAyIGgxIHYxIGgtMVogTTYgMiBoMSB2MSBoLTFaIE03IDIgaDEgdjEgaC0xWiBNOCAyIGgxIHYxIGgtMVogTTE2IDIgaDEgdjEgaC0xWiBNMTcgMiBoMSB2MSBoLTFaIE0xOCAyIGgxIHYxIGgtMVogTTE5IDIgaDEgdjEgaC0xWiBNMjAgMiBoMSB2MSBoLTFaIE0yMSAyIGgxIHYxIGgtMVogTTIyIDIgaDEgdjEgaC0xWiBNMiAzIGgxIHYxIGgtMVogTTggMyBoMSB2MSBoLTFaIE0xNiAzIGgxIHYxIGgtMVogTTIyIDMgaDEgdjEgaC0xWiBNMiA0IGgxIHYxIGgtMVogTTggNCBoMSB2MSBoLTFaIE0xNiA0IGgxIHYxIGgtMVogTTIyIDQgaDEgdjEgaC0xWiBNMiA1IGgxIHYxIGgtMVogTTggNSBoMSB2MSBoLTFaIE0xNiA1IGgxIHYxIGgtMVogTTIyIDUgaDEgdjEgaC0xWiBNMiA2IGgxIHYxIGgtMVogTTggNiBoMSB2MSBoLTFaIE0xNiA2IGgxIHYxIGgtMVogTTIyIDYgaDEgdjEgaC0xWiBNMiA3IGgxIHYxIGgtMVogTTggNyBoMSB2MSBoLTFaIE0xNiA3IGgxIHYxIGgtMVogTTIyIDcgaDEgdjEgaC0xWiBNMiA4IGgxIHYxIGgtMVogTTMgOCBoMSB2MSBoLTFaIE00IDggaDEgdjEgaC0xWiBNNSA4IGgxIHYxIGgtMVogTTYgOCBoMSB2MSBoLTFaIE03IDggaDEgdjEgaC0xWiBNOCA4IGgxIHYxIGgtMVogTTE2IDggaDEgdjEgaC0xWiBNMTcgOCBoMSB2MSBoLTFaIE0xOCA4IGgxIHYxIGgtMVogTTE5IDggaDEgdjEgaC0xWiBNMjAgOCBoMSB2MSBoLTFaIE0yMSA4IGgxIHYxIGgtMVogTTIyIDggaDEgdjEgaC0xWiBNMiAxNiBoMSB2MSBoLTFaIE0zIDE2IGgxIHYxIGgtMVogTTQgMTYgaDEgdjEgaC0xWiBNNSAxNiBoMSB2MSBoLTFaIE02IDE2IGgxIHYxIGgtMVogTTcgMTYgaDEgdjEgaC0xWiBNOCAxNiBoMSB2MSBoLTFaIE0yIDE3IGgxIHYxIGgtMVogTTggMTcgaDEgdjEgaC0xWiBNMiAxOCBoMSB2MSBoLTFaIE04IDE4IGgxIHYxIGgtMVogTTIgMTkgaDEgdjEgaC0xWiBNOCAxOSBoMSB2MSBoLTFaIE0yIDIwIGgxIHYxIGgtMVogTTggMjAgaDEgdjEgaC0xWiBNMiAyMSBoMSB2MSBoLTFaIE04IDIxIGgxIHYxIGgtMVogTTIgMjIgaDEgdjEgaC0xWiBNMyAyMiBoMSB2MSBoLTFaIE00IDIyIGgxIHYxIGgtMVogTTUgMjIgaDEgdjEgaC0xWiBNNiAyMiBoMSB2MSBoLTFaIE03IDIyIGgxIHYxIGgtMVogTTggMjIgaDEgdjEgaC0xWiIvPg0KPHBhdGggY2xhc3M9InFyLXRpbWluZy1kYXJrIGRhcmsgcXJjb2RlIiBmaWxsPSIjMDAwIiBkPSJNMTAgOCBoMSB2MSBoLTFaIE0xMiA4IGgxIHYxIGgtMVogTTE0IDggaDEgdjEgaC0xWiBNOCAxMCBoMSB2MSBoLTFaIE04IDEyIGgxIHYxIGgtMVogTTggMTQgaDEgdjEgaC0xWiIvPg0KPHBhdGggY2xhc3M9InFyLWZvcm1hdC1kYXJrIGRhcmsgcXJjb2RlIiBmaWxsPSIjMDAwIiBkPSJNMTAgMiBoMSB2MSBoLTFaIE0xMCA0IGgxIHYxIGgtMVogTTEwIDUgaDEgdjEgaC0xWiBNMTAgNiBoMSB2MSBoLTFaIE0yIDEwIGgxIHYxIGgtMVogTTMgMTAgaDEgdjEgaC0xWiBNNCAxMCBoMSB2MSBoLTFaIE01IDEwIGgxIHYxIGgtMVogTTEwIDEwIGgxIHYxIGgtMVogTTE1IDEwIGgxIHYxIGgtMVogTTE4IDEwIGgxIHYxIGgtMVogTTE5IDEwIGgxIHYxIGgtMVogTTIwIDEwIGgxIHYxIGgtMVogTTIyIDEwIGgxIHYxIGgtMVogTTEwIDE5IGgxIHYxIGgtMVogTTEwIDIwIGgxIHYxIGgtMVogTTEwIDIxIGgxIHYxIGgtMVogTTEwIDIyIGgxIHYxIGgtMVoiLz4NCjxwYXRoIGNsYXNzPSJxci1maW5kZXItZG90IGRhcmsgcXJjb2RlIiBmaWxsPSIjMDAwIiBkPSJNNCA0IGgxIHYxIGgtMVogTTUgNCBoMSB2MSBoLTFaIE02IDQgaDEgdjEgaC0xWiBNMTggNCBoMSB2MSBoLTFaIE0xOSA0IGgxIHYxIGgtMVogTTIwIDQgaDEgdjEgaC0xWiBNNCA1IGgxIHYxIGgtMVogTTUgNSBoMSB2MSBoLTFaIE02IDUgaDEgdjEgaC0xWiBNMTggNSBoMSB2MSBoLTFaIE0xOSA1IGgxIHYxIGgtMVogTTIwIDUgaDEgdjEgaC0xWiBNNCA2IGgxIHYxIGgtMVogTTUgNiBoMSB2MSBoLTFaIE02IDYgaDEgdjEgaC0xWiBNMTggNiBoMSB2MSBoLTFaIE0xOSA2IGgxIHYxIGgtMVogTTIwIDYgaDEgdjEgaC0xWiBNNCAxOCBoMSB2MSBoLTFaIE01IDE4IGgxIHYxIGgtMVogTTYgMTggaDEgdjEgaC0xWiBNNCAxOSBoMSB2MSBoLTFaIE01IDE5IGgxIHYxIGgtMVogTTYgMTkgaDEgdjEgaC0xWiBNNCAyMCBoMSB2MSBoLTFaIE01IDIwIGgxIHYxIGgtMVogTTYgMjAgaDEgdjEgaC0xWiIvPg0KPC9zdmc+DQo=';

    private const DECODED_IMAGE = 'otpauth://totp/test@test.com?secret=A4GRFHVIRBGY7UIW';

    /**
     * @test
     */
    public function setUp() : void
    {
        parent::setUp();
    }

    /**
     * @test
     */
    public function test_encode_returns_correct_value()
    {
        $this->assertEquals(self::STRING_ENCODED, QrCode::encode(self::STRING_TO_ENCODE));
    }

    /**
     * @test
     */
    public function test_decode_valid_image_returns_correct_value()
    {
        $file = LocalFile::fake()->validQrcode();

        $this->assertEquals(self::DECODED_IMAGE, QrCode::decode($file));
    }

    /**
     * @test
     */
    public function test_decode_invalid_image_returns_correct_value()
    {
        $this->expectException(\App\Exceptions\InvalidQrCodeException::class);

        QrCode::decode(LocalFile::fake()->invalidQrcode());
    }
}
