<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Channels;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputchannel channel int topic_id string title long icon_emoji_id bool closed bool hidden
 * @return Updates
 */

final class EditForumTopic extends Instance {
	public function request(object $channel,int $topic_id,? string $title = null,? int $icon_emoji_id = null,? bool $closed = null,? bool $hidden = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xf4dfa185);
		$flags = 0;
		$flags |= is_null($title) ? 0 : (1 << 0);
		$flags |= is_null($icon_emoji_id) ? 0 : (1 << 1);
		$flags |= is_null($closed) ? 0 : (1 << 2);
		$flags |= is_null($hidden) ? 0 : (1 << 3);
		$writer->writeInt($flags);
		$writer->write($channel->read());
		$writer->writeInt($topic_id);
		if(is_null($title) === false):
			$writer->tgwriteBytes($title);
		endif;
		if(is_null($icon_emoji_id) === false):
			$writer->writeLong($icon_emoji_id);
		endif;
		if(is_null($closed) === false):
			$writer->tgwriteBool($closed);
		endif;
		if(is_null($hidden) === false):
			$writer->tgwriteBool($hidden);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>