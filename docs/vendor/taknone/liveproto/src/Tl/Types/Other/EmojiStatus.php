<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long document_id int until
 * @return EmojiStatus
 */

final class EmojiStatus extends Instance {
	public function request(int $document_id,? int $until = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xe7ff068a);
		$flags = 0;
		$flags |= is_null($until) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->writeLong($document_id);
		if(is_null($until) === false):
			$writer->writeInt($until);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		$result['document_id'] = $reader->readLong();
		if($flags & (1 << 0)):
			$result['until'] = $reader->readInt();
		else:
			$result['until'] = null;
		endif;
		return new self($result);
	}
}

?>