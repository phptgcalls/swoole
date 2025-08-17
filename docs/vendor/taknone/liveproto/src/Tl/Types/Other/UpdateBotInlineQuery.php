<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long query_id long user_id string query string offset geopoint geo inlinequerypeertype peer_type
 * @return Update
 */

final class UpdateBotInlineQuery extends Instance {
	public function request(int $query_id,int $user_id,string $query,string $offset,? object $geo = null,? object $peer_type = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x496f379c);
		$flags = 0;
		$flags |= is_null($geo) ? 0 : (1 << 0);
		$flags |= is_null($peer_type) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		$writer->writeLong($query_id);
		$writer->writeLong($user_id);
		$writer->tgwriteBytes($query);
		if(is_null($geo) === false):
			$writer->write($geo->read());
		endif;
		if(is_null($peer_type) === false):
			$writer->write($peer_type->read());
		endif;
		$writer->tgwriteBytes($offset);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		$result['query_id'] = $reader->readLong();
		$result['user_id'] = $reader->readLong();
		$result['query'] = $reader->tgreadBytes();
		if($flags & (1 << 0)):
			$result['geo'] = $reader->tgreadObject();
		else:
			$result['geo'] = null;
		endif;
		if($flags & (1 << 1)):
			$result['peer_type'] = $reader->tgreadObject();
		else:
			$result['peer_type'] = null;
		endif;
		$result['offset'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>