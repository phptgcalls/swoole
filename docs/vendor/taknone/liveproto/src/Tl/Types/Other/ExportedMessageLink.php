<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string link string html
 * @return ExportedMessageLink
 */

final class ExportedMessageLink extends Instance {
	public function request(string $link,string $html) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x5dab1af4);
		$writer->tgwriteBytes($link);
		$writer->tgwriteBytes($html);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['link'] = $reader->tgreadBytes();
		$result['html'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>