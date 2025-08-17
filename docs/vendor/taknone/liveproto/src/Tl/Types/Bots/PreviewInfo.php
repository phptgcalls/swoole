<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Bots;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<BotPreviewMedia> media Vector<string> lang_codes
 * @return bots.PreviewInfo
 */

final class PreviewInfo extends Instance {
	public function request(array $media,array $lang_codes) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xca71d64);
		$writer->tgwriteVector($media,'BotPreviewMedia');
		$writer->tgwriteVector($lang_codes,'string');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['media'] = $reader->tgreadVector('BotPreviewMedia');
		$result['lang_codes'] = $reader->tgreadVector('string');
		return new self($result);
	}
}

?>