<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Help;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string referer
 * @return help.RecentMeUrls
 */

final class GetRecentMeUrls extends Instance {
	public function request(string $referer) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x3dc0f114);
		$writer->tgwriteBytes($referer);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>