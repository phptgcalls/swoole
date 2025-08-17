<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string q messagesfilter filter int min_date int max_date int offset_rate inputpeer offset_peer int offset_id int limit true broadcasts_only true groups_only true users_only int folder_id
 * @return messages.Messages
 */

final class SearchGlobal extends Instance {
	public function request(string $q,object $filter,int $min_date,int $max_date,int $offset_rate,object $offset_peer,int $offset_id,int $limit,? true $broadcasts_only = null,? true $groups_only = null,? true $users_only = null,? int $folder_id = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x4bc6589a);
		$flags = 0;
		$flags |= is_null($broadcasts_only) ? 0 : (1 << 1);
		$flags |= is_null($groups_only) ? 0 : (1 << 2);
		$flags |= is_null($users_only) ? 0 : (1 << 3);
		$flags |= is_null($folder_id) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		if(is_null($folder_id) === false):
			$writer->writeInt($folder_id);
		endif;
		$writer->tgwriteBytes($q);
		$writer->write($filter->read());
		$writer->writeInt($min_date);
		$writer->writeInt($max_date);
		$writer->writeInt($offset_rate);
		$writer->write($offset_peer->read());
		$writer->writeInt($offset_id);
		$writer->writeInt($limit);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>