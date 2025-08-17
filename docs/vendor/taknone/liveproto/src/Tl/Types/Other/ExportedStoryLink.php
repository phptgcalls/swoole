<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string link
 * @return ExportedStoryLink
 */

final class ExportedStoryLink extends Instance {
	public function request(string $link) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x3fc9053b);
		$writer->tgwriteBytes($link);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['link'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>