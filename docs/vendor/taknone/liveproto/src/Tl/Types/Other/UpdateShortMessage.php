<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int id long user_id string message int pts int pts_count int date true out true mentioned true media_unread true silent messagefwdheader fwd_from long via_bot_id messagereplyheader reply_to Vector<MessageEntity> entities int ttl_period
 * @return Updates
 */

final class UpdateShortMessage extends Instance {
	public function request(int $id,int $user_id,string $message,int $pts,int $pts_count,int $date,? true $out = null,? true $mentioned = null,? true $media_unread = null,? true $silent = null,? object $fwd_from = null,? int $via_bot_id = null,? object $reply_to = null,? array $entities = null,? int $ttl_period = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x313bc7f8);
		$flags = 0;
		$flags |= is_null($out) ? 0 : (1 << 1);
		$flags |= is_null($mentioned) ? 0 : (1 << 4);
		$flags |= is_null($media_unread) ? 0 : (1 << 5);
		$flags |= is_null($silent) ? 0 : (1 << 13);
		$flags |= is_null($fwd_from) ? 0 : (1 << 2);
		$flags |= is_null($via_bot_id) ? 0 : (1 << 11);
		$flags |= is_null($reply_to) ? 0 : (1 << 3);
		$flags |= is_null($entities) ? 0 : (1 << 7);
		$flags |= is_null($ttl_period) ? 0 : (1 << 25);
		$writer->writeInt($flags);
		$writer->writeInt($id);
		$writer->writeLong($user_id);
		$writer->tgwriteBytes($message);
		$writer->writeInt($pts);
		$writer->writeInt($pts_count);
		$writer->writeInt($date);
		if(is_null($fwd_from) === false):
			$writer->write($fwd_from->read());
		endif;
		if(is_null($via_bot_id) === false):
			$writer->writeLong($via_bot_id);
		endif;
		if(is_null($reply_to) === false):
			$writer->write($reply_to->read());
		endif;
		if(is_null($entities) === false):
			$writer->tgwriteVector($entities,'MessageEntity');
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
		if($flags & (1 << 13)):
			$result['silent'] = true;
		else:
			$result['silent'] = false;
		endif;
		$result['id'] = $reader->readInt();
		$result['user_id'] = $reader->readLong();
		$result['message'] = $reader->tgreadBytes();
		$result['pts'] = $reader->readInt();
		$result['pts_count'] = $reader->readInt();
		$result['date'] = $reader->readInt();
		if($flags & (1 << 2)):
			$result['fwd_from'] = $reader->tgreadObject();
		else:
			$result['fwd_from'] = null;
		endif;
		if($flags & (1 << 11)):
			$result['via_bot_id'] = $reader->readLong();
		else:
			$result['via_bot_id'] = null;
		endif;
		if($flags & (1 << 3)):
			$result['reply_to'] = $reader->tgreadObject();
		else:
			$result['reply_to'] = null;
		endif;
		if($flags & (1 << 7)):
			$result['entities'] = $reader->tgreadVector('MessageEntity');
		else:
			$result['entities'] = null;
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