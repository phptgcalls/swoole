<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer string q messagesfilter filter int min_date int max_date int offset_id int add_offset int limit int max_id int min_id long hash inputpeer from_id inputpeer saved_peer_id Vector<Reaction> saved_reaction int top_msg_id
 * @return messages.Messages
 */

final class Search extends Instance {
	public function request(object $peer,string $q,object $filter,int $min_date,int $max_date,int $offset_id,int $add_offset,int $limit,int $max_id,int $min_id,int $hash,? object $from_id = null,? object $saved_peer_id = null,? array $saved_reaction = null,? int $top_msg_id = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x29ee847a);
		$flags = 0;
		$flags |= is_null($from_id) ? 0 : (1 << 0);
		$flags |= is_null($saved_peer_id) ? 0 : (1 << 2);
		$flags |= is_null($saved_reaction) ? 0 : (1 << 3);
		$flags |= is_null($top_msg_id) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		$writer->write($peer->read());
		$writer->tgwriteBytes($q);
		if(is_null($from_id) === false):
			$writer->write($from_id->read());
		endif;
		if(is_null($saved_peer_id) === false):
			$writer->write($saved_peer_id->read());
		endif;
		if(is_null($saved_reaction) === false):
			$writer->tgwriteVector($saved_reaction,'Reaction');
		endif;
		if(is_null($top_msg_id) === false):
			$writer->writeInt($top_msg_id);
		endif;
		$writer->write($filter->read());
		$writer->writeInt($min_date);
		$writer->writeInt($max_date);
		$writer->writeInt($offset_id);
		$writer->writeInt($add_offset);
		$writer->writeInt($limit);
		$writer->writeInt($max_id);
		$writer->writeInt($min_id);
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