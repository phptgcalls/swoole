<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputstickerset stickerset int thumb_version
 * @return InputFileLocation
 */

final class InputStickerSetThumb extends Instance {
	public function request(object $stickerset,int $thumb_version) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x9d84f3db);
		$writer->write($stickerset->read());
		$writer->writeInt($thumb_version);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['stickerset'] = $reader->tgreadObject();
		$result['thumb_version'] = $reader->readInt();
		return new self($result);
	}
}

?>