<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int until_date true view_messages true send_messages true send_media true send_stickers true send_gifs true send_games true send_inline true embed_links true send_polls true change_info true invite_users true pin_messages true manage_topics true send_photos true send_videos true send_roundvideos true send_audios true send_voices true send_docs true send_plain
 * @return ChatBannedRights
 */

final class ChatBannedRights extends Instance {
	public function request(int $until_date,? true $view_messages = null,? true $send_messages = null,? true $send_media = null,? true $send_stickers = null,? true $send_gifs = null,? true $send_games = null,? true $send_inline = null,? true $embed_links = null,? true $send_polls = null,? true $change_info = null,? true $invite_users = null,? true $pin_messages = null,? true $manage_topics = null,? true $send_photos = null,? true $send_videos = null,? true $send_roundvideos = null,? true $send_audios = null,? true $send_voices = null,? true $send_docs = null,? true $send_plain = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x9f120418);
		$flags = 0;
		$flags |= is_null($view_messages) ? 0 : (1 << 0);
		$flags |= is_null($send_messages) ? 0 : (1 << 1);
		$flags |= is_null($send_media) ? 0 : (1 << 2);
		$flags |= is_null($send_stickers) ? 0 : (1 << 3);
		$flags |= is_null($send_gifs) ? 0 : (1 << 4);
		$flags |= is_null($send_games) ? 0 : (1 << 5);
		$flags |= is_null($send_inline) ? 0 : (1 << 6);
		$flags |= is_null($embed_links) ? 0 : (1 << 7);
		$flags |= is_null($send_polls) ? 0 : (1 << 8);
		$flags |= is_null($change_info) ? 0 : (1 << 10);
		$flags |= is_null($invite_users) ? 0 : (1 << 15);
		$flags |= is_null($pin_messages) ? 0 : (1 << 17);
		$flags |= is_null($manage_topics) ? 0 : (1 << 18);
		$flags |= is_null($send_photos) ? 0 : (1 << 19);
		$flags |= is_null($send_videos) ? 0 : (1 << 20);
		$flags |= is_null($send_roundvideos) ? 0 : (1 << 21);
		$flags |= is_null($send_audios) ? 0 : (1 << 22);
		$flags |= is_null($send_voices) ? 0 : (1 << 23);
		$flags |= is_null($send_docs) ? 0 : (1 << 24);
		$flags |= is_null($send_plain) ? 0 : (1 << 25);
		$writer->writeInt($flags);
		$writer->writeInt($until_date);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['view_messages'] = true;
		else:
			$result['view_messages'] = false;
		endif;
		if($flags & (1 << 1)):
			$result['send_messages'] = true;
		else:
			$result['send_messages'] = false;
		endif;
		if($flags & (1 << 2)):
			$result['send_media'] = true;
		else:
			$result['send_media'] = false;
		endif;
		if($flags & (1 << 3)):
			$result['send_stickers'] = true;
		else:
			$result['send_stickers'] = false;
		endif;
		if($flags & (1 << 4)):
			$result['send_gifs'] = true;
		else:
			$result['send_gifs'] = false;
		endif;
		if($flags & (1 << 5)):
			$result['send_games'] = true;
		else:
			$result['send_games'] = false;
		endif;
		if($flags & (1 << 6)):
			$result['send_inline'] = true;
		else:
			$result['send_inline'] = false;
		endif;
		if($flags & (1 << 7)):
			$result['embed_links'] = true;
		else:
			$result['embed_links'] = false;
		endif;
		if($flags & (1 << 8)):
			$result['send_polls'] = true;
		else:
			$result['send_polls'] = false;
		endif;
		if($flags & (1 << 10)):
			$result['change_info'] = true;
		else:
			$result['change_info'] = false;
		endif;
		if($flags & (1 << 15)):
			$result['invite_users'] = true;
		else:
			$result['invite_users'] = false;
		endif;
		if($flags & (1 << 17)):
			$result['pin_messages'] = true;
		else:
			$result['pin_messages'] = false;
		endif;
		if($flags & (1 << 18)):
			$result['manage_topics'] = true;
		else:
			$result['manage_topics'] = false;
		endif;
		if($flags & (1 << 19)):
			$result['send_photos'] = true;
		else:
			$result['send_photos'] = false;
		endif;
		if($flags & (1 << 20)):
			$result['send_videos'] = true;
		else:
			$result['send_videos'] = false;
		endif;
		if($flags & (1 << 21)):
			$result['send_roundvideos'] = true;
		else:
			$result['send_roundvideos'] = false;
		endif;
		if($flags & (1 << 22)):
			$result['send_audios'] = true;
		else:
			$result['send_audios'] = false;
		endif;
		if($flags & (1 << 23)):
			$result['send_voices'] = true;
		else:
			$result['send_voices'] = false;
		endif;
		if($flags & (1 << 24)):
			$result['send_docs'] = true;
		else:
			$result['send_docs'] = false;
		endif;
		if($flags & (1 << 25)):
			$result['send_plain'] = true;
		else:
			$result['send_plain'] = false;
		endif;
		$result['until_date'] = $reader->readInt();
		return new self($result);
	}
}

?>