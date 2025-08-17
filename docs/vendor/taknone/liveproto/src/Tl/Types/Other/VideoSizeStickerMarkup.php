<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputstickerset stickerset long sticker_id Vector<int> background_colors
 * @return VideoSize
 */

final class VideoSizeStickerMarkup extends Instance {
	public function request(object $stickerset,int $sticker_id,array $background_colors) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xda082fe);
		$writer->write($stickerset->read());
		$writer->writeLong($sticker_id);
		$writer->tgwriteVector($background_colors,'int');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['stickerset'] = $reader->tgreadObject();
		$result['sticker_id'] = $reader->readLong();
		$result['background_colors'] = $reader->tgreadVector('int');
		return new self($result);
	}
}

?>