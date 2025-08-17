<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Bots;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputuser bot string lang_code inputmedia media inputmedia new_media
 * @return BotPreviewMedia
 */

final class EditPreviewMedia extends Instance {
	public function request(object $bot,string $lang_code,object $media,object $new_media) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x8525606f);
		$writer->write($bot->read());
		$writer->tgwriteBytes($lang_code);
		$writer->write($media->read());
		$writer->write($new_media->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>