<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer long photo_id true big
 * @return InputFileLocation
 */

final class InputPeerPhotoFileLocation extends Instance {
	public function request(object $peer,int $photo_id,? true $big = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x37257e99);
		$flags = 0;
		$flags |= is_null($big) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->write($peer->read());
		$writer->writeLong($photo_id);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['big'] = true;
		else:
			$result['big'] = false;
		endif;
		$result['peer'] = $reader->tgreadObject();
		$result['photo_id'] = $reader->readLong();
		return new self($result);
	}
}

?>