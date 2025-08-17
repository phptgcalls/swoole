<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Bots;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputuser bot string lang_code
 * @return bots.PreviewInfo
 */

final class GetPreviewInfo extends Instance {
	public function request(object $bot,string $lang_code) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x423ab3ad);
		$writer->write($bot->read());
		$writer->tgwriteBytes($lang_code);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>