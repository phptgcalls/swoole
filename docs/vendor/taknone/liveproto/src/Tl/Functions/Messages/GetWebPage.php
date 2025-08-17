<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string url int hash
 * @return messages.WebPage
 */

final class GetWebPage extends Instance {
	public function request(string $url,int $hash) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x8d9692a3);
		$writer->tgwriteBytes($url);
		$writer->writeInt($hash);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>