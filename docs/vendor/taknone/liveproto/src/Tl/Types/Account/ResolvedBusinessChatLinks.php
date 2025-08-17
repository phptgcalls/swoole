<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Account;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param peer peer string message Vector<Chat> chats Vector<User> users Vector<MessageEntity> entities
 * @return account.ResolvedBusinessChatLinks
 */

final class ResolvedBusinessChatLinks extends Instance {
	public function request(object $peer,string $message,array $chats,array $users,? array $entities = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x9a23af21);
		$flags = 0;
		$flags |= is_null($entities) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->write($peer->read());
		$writer->tgwriteBytes($message);
		if(is_null($entities) === false):
			$writer->tgwriteVector($entities,'MessageEntity');
		endif;
		$writer->tgwriteVector($chats,'Chat');
		$writer->tgwriteVector($users,'User');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		$result['peer'] = $reader->tgreadObject();
		$result['message'] = $reader->tgreadBytes();
		if($flags & (1 << 0)):
			$result['entities'] = $reader->tgreadVector('MessageEntity');
		else:
			$result['entities'] = null;
		endif;
		$result['chats'] = $reader->tgreadVector('Chat');
		$result['users'] = $reader->tgreadVector('User');
		return new self($result);
	}
}

?>