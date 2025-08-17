<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int id peer peer_id int date messageaction action true out true mentioned true media_unread true reactions_are_possible true silent true post true legacy peer from_id peer saved_peer_id messagereplyheader reply_to messagereactions reactions int ttl_period
 * @return Message
 */

final class MessageService extends Instance {
	public function request(int $id,object $peer_id,int $date,object $action,? true $out = null,? true $mentioned = null,? true $media_unread = null,? true $reactions_are_possible = null,? true $silent = null,? true $post = null,? true $legacy = null,? object $from_id = null,? object $saved_peer_id = null,? object $reply_to = null,? object $reactions = null,? int $ttl_period = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x7a800e0a);
		$flags = 0;
		$flags |= is_null($out) ? 0 : (1 << 1);
		$flags |= is_null($mentioned) ? 0 : (1 << 4);
		$flags |= is_null($media_unread) ? 0 : (1 << 5);
		$flags |= is_null($reactions_are_possible) ? 0 : (1 << 9);
		$flags |= is_null($silent) ? 0 : (1 << 13);
		$flags |= is_null($post) ? 0 : (1 << 14);
		$flags |= is_null($legacy) ? 0 : (1 << 19);
		$flags |= is_null($from_id) ? 0 : (1 << 8);
		$flags |= is_null($saved_peer_id) ? 0 : (1 << 28);
		$flags |= is_null($reply_to) ? 0 : (1 << 3);
		$flags |= is_null($reactions) ? 0 : (1 << 20);
		$flags |= is_null($ttl_period) ? 0 : (1 << 25);
		$writer->writeInt($flags);
		$writer->writeInt($id);
		if(is_null($from_id) === false):
			$writer->write($from_id->read());
		endif;
		$writer->write($peer_id->read());
		if(is_null($saved_peer_id) === false):
			$writer->write($saved_peer_id->read());
		endif;
		if(is_null($reply_to) === false):
			$writer->write($reply_to->read());
		endif;
		$writer->writeInt($date);
		$writer->write($action->read());
		if(is_null($reactions) === false):
			$writer->write($reactions->read());
		endif;
		if(is_null($ttl_period) === false):
			$writer->writeInt($ttl_period);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 1)):
			$result['out'] = true;
		else:
			$result['out'] = false;
		endif;
		if($flags & (1 << 4)):
			$result['mentioned'] = true;
		else:
			$result['mentioned'] = false;
		endif;
		if($flags & (1 << 5)):
			$result['media_unread'] = true;
		else:
			$result['media_unread'] = false;
		endif;
		if($flags & (1 << 9)):
			$result['reactions_are_possible'] = true;
		else:
			$result['reactions_are_possible'] = false;
		endif;
		if($flags & (1 << 13)):
			$result['silent'] = true;
		else:
			$result['silent'] = false;
		endif;
		if($flags & (1 << 14)):
			$result['post'] = true;
		else:
			$result['post'] = false;
		endif;
		if($flags & (1 << 19)):
			$result['legacy'] = true;
		else:
			$result['legacy'] = false;
		endif;
		$result['id'] = $reader->readInt();
		if($flags & (1 << 8)):
			$result['from_id'] = $reader->tgreadObject();
		else:
			$result['from_id'] = null;
		endif;
		$result['peer_id'] = $reader->tgreadObject();
		if($flags & (1 << 28)):
			$result['saved_peer_id'] = $reader->tgreadObject();
		else:
			$result['saved_peer_id'] = null;
		endif;
		if($flags & (1 << 3)):
			$result['reply_to'] = $reader->tgreadObject();
		else:
			$result['reply_to'] = null;
		endif;
		$result['date'] = $reader->readInt();
		$result['action'] = $reader->tgreadObject();
		if($flags & (1 << 20)):
			$result['reactions'] = $reader->tgreadObject();
		else:
			$result['reactions'] = null;
		endif;
		if($flags & (1 << 25)):
			$result['ttl_period'] = $reader->readInt();
		else:
			$result['ttl_period'] = null;
		endif;
		return new self($result);
	}
}

?>