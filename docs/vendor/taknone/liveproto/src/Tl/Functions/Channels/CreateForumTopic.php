<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Channels;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputchannel channel string title long random_id int icon_color long icon_emoji_id inputpeer send_as
 * @return Updates
 */

final class CreateForumTopic extends Instance {
	public function request(object $channel,string $title,int $random_id,? int $icon_color = null,? int $icon_emoji_id = null,? object $send_as = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xf40c0224);
		$flags = 0;
		$flags |= is_null($icon_color) ? 0 : (1 << 0);
		$flags |= is_null($icon_emoji_id) ? 0 : (1 << 3);
		$flags |= is_null($send_as) ? 0 : (1 << 2);
		$writer->writeInt($flags);
		$writer->write($channel->read());
		$writer->tgwriteBytes($title);
		if(is_null($icon_color) === false):
			$writer->writeInt($icon_color);
		endif;
		if(is_null($icon_emoji_id) === false):
			$writer->writeLong($icon_emoji_id);
		endif;
		$writer->writeLong($random_id);
		if(is_null($send_as) === false):
			$writer->write($send_as->read());
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