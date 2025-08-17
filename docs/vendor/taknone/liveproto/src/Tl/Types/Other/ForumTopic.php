<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int id int date string title int icon_color int top_message int read_inbox_max_id int read_outbox_max_id int unread_count int unread_mentions_count int unread_reactions_count peer from_id peernotifysettings notify_settings true my true closed true pinned true short true hidden long icon_emoji_id draftmessage draft
 * @return ForumTopic
 */

final class ForumTopic extends Instance {
	public function request(int $id,int $date,string $title,int $icon_color,int $top_message,int $read_inbox_max_id,int $read_outbox_max_id,int $unread_count,int $unread_mentions_count,int $unread_reactions_count,object $from_id,object $notify_settings,? true $my = null,? true $closed = null,? true $pinned = null,? true $short = null,? true $hidden = null,? int $icon_emoji_id = null,? object $draft = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x71701da9);
		$flags = 0;
		$flags |= is_null($my) ? 0 : (1 << 1);
		$flags |= is_null($closed) ? 0 : (1 << 2);
		$flags |= is_null($pinned) ? 0 : (1 << 3);
		$flags |= is_null($short) ? 0 : (1 << 5);
		$flags |= is_null($hidden) ? 0 : (1 << 6);
		$flags |= is_null($icon_emoji_id) ? 0 : (1 << 0);
		$flags |= is_null($draft) ? 0 : (1 << 4);
		$writer->writeInt($flags);
		$writer->writeInt($id);
		$writer->writeInt($date);
		$writer->tgwriteBytes($title);
		$writer->writeInt($icon_color);
		if(is_null($icon_emoji_id) === false):
			$writer->writeLong($icon_emoji_id);
		endif;
		$writer->writeInt($top_message);
		$writer->writeInt($read_inbox_max_id);
		$writer->writeInt($read_outbox_max_id);
		$writer->writeInt($unread_count);
		$writer->writeInt($unread_mentions_count);
		$writer->writeInt($unread_reactions_count);
		$writer->write($from_id->read());
		$writer->write($notify_settings->read());
		if(is_null($draft) === false):
			$writer->write($draft->read());
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 1)):
			$result['my'] = true;
		else:
			$result['my'] = false;
		endif;
		if($flags & (1 << 2)):
			$result['closed'] = true;
		else:
			$result['closed'] = false;
		endif;
		if($flags & (1 << 3)):
			$result['pinned'] = true;
		else:
			$result['pinned'] = false;
		endif;
		if($flags & (1 << 5)):
			$result['short'] = true;
		else:
			$result['short'] = false;
		endif;
		if($flags & (1 << 6)):
			$result['hidden'] = true;
		else:
			$result['hidden'] = false;
		endif;
		$result['id'] = $reader->readInt();
		$result['date'] = $reader->readInt();
		$result['title'] = $reader->tgreadBytes();
		$result['icon_color'] = $reader->readInt();
		if($flags & (1 << 0)):
			$result['icon_emoji_id'] = $reader->readLong();
		else:
			$result['icon_emoji_id'] = null;
		endif;
		$result['top_message'] = $reader->readInt();
		$result['read_inbox_max_id'] = $reader->readInt();
		$result['read_outbox_max_id'] = $reader->readInt();
		$result['unread_count'] = $reader->readInt();
		$result['unread_mentions_count'] = $reader->readInt();
		$result['unread_reactions_count'] = $reader->readInt();
		$result['from_id'] = $reader->tgreadObject();
		$result['notify_settings'] = $reader->tgreadObject();
		if($flags & (1 << 4)):
			$result['draft'] = $reader->tgreadObject();
		else:
			$result['draft'] = null;
		endif;
		return new self($result);
	}
}

?>