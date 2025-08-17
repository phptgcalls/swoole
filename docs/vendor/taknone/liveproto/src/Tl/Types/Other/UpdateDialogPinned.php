<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param dialogpeer peer true pinned int folder_id
 * @return Update
 */

final class UpdateDialogPinned extends Instance {
	public function request(object $peer,? true $pinned = null,? int $folder_id = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x6e6fe51c);
		$flags = 0;
		$flags |= is_null($pinned) ? 0 : (1 << 0);
		$flags |= is_null($folder_id) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		if(is_null($folder_id) === false):
			$writer->writeInt($folder_id);
		endif;
		$writer->write($peer->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['pinned'] = true;
		else:
			$result['pinned'] = false;
		endif;
		if($flags & (1 << 1)):
			$result['folder_id'] = $reader->readInt();
		else:
			$result['folder_id'] = null;
		endif;
		$result['peer'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>