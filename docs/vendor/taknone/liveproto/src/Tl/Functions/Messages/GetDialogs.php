<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int offset_date int offset_id inputpeer offset_peer int limit long hash true exclude_pinned int folder_id
 * @return messages.Dialogs
 */

final class GetDialogs extends Instance {
	public function request(int $offset_date,int $offset_id,object $offset_peer,int $limit,int $hash,? true $exclude_pinned = null,? int $folder_id = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xa0f4cb4f);
		$flags = 0;
		$flags |= is_null($exclude_pinned) ? 0 : (1 << 0);
		$flags |= is_null($folder_id) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		if(is_null($folder_id) === false):
			$writer->writeInt($folder_id);
		endif;
		$writer->writeInt($offset_date);
		$writer->writeInt($offset_id);
		$writer->write($offset_peer->read());
		$writer->writeInt($limit);
		$writer->writeLong($hash);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>