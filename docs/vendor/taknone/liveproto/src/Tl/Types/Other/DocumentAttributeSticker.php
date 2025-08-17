<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string alt inputstickerset stickerset true mask maskcoords mask_coords
 * @return DocumentAttribute
 */

final class DocumentAttributeSticker extends Instance {
	public function request(string $alt,object $stickerset,? true $mask = null,? object $mask_coords = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x6319d612);
		$flags = 0;
		$flags |= is_null($mask) ? 0 : (1 << 1);
		$flags |= is_null($mask_coords) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->tgwriteBytes($alt);
		$writer->write($stickerset->read());
		if(is_null($mask_coords) === false):
			$writer->write($mask_coords->read());
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 1)):
			$result['mask'] = true;
		else:
			$result['mask'] = false;
		endif;
		$result['alt'] = $reader->tgreadBytes();
		$result['stickerset'] = $reader->tgreadObject();
		if($flags & (1 << 0)):
			$result['mask_coords'] = $reader->tgreadObject();
		else:
			$result['mask_coords'] = null;
		endif;
		return new self($result);
	}
}

?>