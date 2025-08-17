<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Chatlists;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param textwithentities title Vector<Peer> peers Vector<Chat> chats Vector<User> users true title_noanimate string emoticon
 * @return chatlists.ChatlistInvite
 */

final class ChatlistInvite extends Instance {
	public function request(object $title,array $peers,array $chats,array $users,? true $title_noanimate = null,? string $emoticon = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xf10ece2f);
		$flags = 0;
		$flags |= is_null($title_noanimate) ? 0 : (1 << 1);
		$flags |= is_null($emoticon) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->write($title->read());
		if(is_null($emoticon) === false):
			$writer->tgwriteBytes($emoticon);
		endif;
		$writer->tgwriteVector($peers,'Peer');
		$writer->tgwriteVector($chats,'Chat');
		$writer->tgwriteVector($users,'User');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 1)):
			$result['title_noanimate'] = true;
		else:
			$result['title_noanimate'] = false;
		endif;
		$result['title'] = $reader->tgreadObject();
		if($flags & (1 << 0)):
			$result['emoticon'] = $reader->tgreadBytes();
		else:
			$result['emoticon'] = null;
		endif;
		$result['peers'] = $reader->tgreadVector('Peer');
		$result['chats'] = $reader->tgreadVector('Chat');
		$result['users'] = $reader->tgreadVector('User');
		return new self($result);
	}
}

?>