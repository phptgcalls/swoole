<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long query_id botinlineresult result Vector<InlineQueryPeerType> peer_types int cache_time Vector<User> users
 * @return messages.PreparedInlineMessage
 */

final class PreparedInlineMessage extends Instance {
	public function request(int $query_id,object $result,array $peer_types,int $cache_time,array $users) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xff57708d);
		$writer->writeLong($query_id);
		$writer->write($result->read());
		$writer->tgwriteVector($peer_types,'InlineQueryPeerType');
		$writer->writeInt($cache_time);
		$writer->tgwriteVector($users,'User');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['query_id'] = $reader->readLong();
		$result['result'] = $reader->tgreadObject();
		$result['peer_types'] = $reader->tgreadVector('InlineQueryPeerType');
		$result['cache_time'] = $reader->readInt();
		$result['users'] = $reader->tgreadVector('User');
		return new self($result);
	}
}

?>