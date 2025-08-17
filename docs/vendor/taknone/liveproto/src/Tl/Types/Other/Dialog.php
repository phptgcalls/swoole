<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param peer peer int top_message int read_inbox_max_id int read_outbox_max_id int unread_count int unread_mentions_count int unread_reactions_count peernotifysettings notify_settings true pinned true unread_mark true view_forum_as_messages int pts draftmessage draft int folder_id int ttl_period
 * @return Dialog
 */

final class Dialog extends Instance {
	public function request(object $peer,int $top_message,int $read_inbox_max_id,int $read_outbox_max_id,int $unread_count,int $unread_mentions_count,int $unread_reactions_count,object $notify_settings,? true $pinned = null,? true $unread_mark = null,? true $view_forum_as_messages = null,? int $pts = null,? object $draft = null,? int $folder_id = null,? int $ttl_period = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xd58a08c6);
		$flags = 0;
		$flags |= is_null($pinned) ? 0 : (1 << 2);
		$flags |= is_null($unread_mark) ? 0 : (1 << 3);
		$flags |= is_null($view_forum_as_messages) ? 0 : (1 << 6);
		$flags |= is_null($pts) ? 0 : (1 << 0);
		$flags |= is_null($draft) ? 0 : (1 << 1);
		$flags |= is_null($folder_id) ? 0 : (1 << 4);
		$flags |= is_null($ttl_period) ? 0 : (1 << 5);
		$writer->writeInt($flags);
		$writer->write($peer->read());
		$writer->writeInt($top_message);
		$writer->writeInt($read_inbox_max_id);
		$writer->writeInt($read_outbox_max_id);
		$writer->writeInt($unread_count);
		$writer->writeInt($unread_mentions_count);
		$writer->writeInt($unread_reactions_count);
		$writer->write($notify_settings->read());
		if(is_null($pts) === false):
			$writer->writeInt($pts);
		endif;
		if(is_null($draft) === false):
			$writer->write($draft->read());
		endif;
		if(is_null($folder_id) === false):
			$writer->writeInt($folder_id);
		endif;
		if(is_null($ttl_period) === false):
			$writer->writeInt($ttl_period);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 2)):
			$result['pinned'] = true;
		else:
			$result['pinned'] = false;
		endif;
		if($flags & (1 << 3)):
			$result['unread_mark'] = true;
		else:
			$result['unread_mark'] = false;
		endif;
		if($flags & (1 << 6)):
			$result['view_forum_as_messages'] = true;
		else:
			$result['view_forum_as_messages'] = false;
		endif;
		$result['peer'] = $reader->tgreadObject();
		$result['top_message'] = $reader->readInt();
		$result['read_inbox_max_id'] = $reader->readInt();
		$result['read_outbox_max_id'] = $reader->readInt();
		$result['unread_count'] = $reader->readInt();
		$result['unread_mentions_count'] = $reader->readInt();
		$result['unread_reactions_count'] = $reader->readInt();
		$result['notify_settings'] = $reader->tgreadObject();
		if($flags & (1 << 0)):
			$result['pts'] = $reader->readInt();
		else:
			$result['pts'] = null;
		endif;
		if($flags & (1 << 1)):
			$result['draft'] = $reader->tgreadObject();
		else:
			$result['draft'] = null;
		endif;
		if($flags & (1 << 4)):
			$result['folder_id'] = $reader->readInt();
		else:
			$result['folder_id'] = null;
		endif;
		if($flags & (1 << 5)):
			$result['ttl_period'] = $reader->readInt();
		else:
			$result['ttl_period'] = null;
		endif;
		return new self($result);
	}
}

?>