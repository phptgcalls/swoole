<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Bots;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputuser bot string lang_code Vector<InputMedia> media
 * @return Bool
 */

final class DeletePreviewMedia extends Instance {
	public function request(object $bot,string $lang_code,array $media) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x2d0135b3);
		$writer->write($bot->read());
		$writer->tgwriteBytes($lang_code);
		$writer->tgwriteVector($media,'InputMedia');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>