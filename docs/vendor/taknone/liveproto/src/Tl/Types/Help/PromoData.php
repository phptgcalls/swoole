<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Help;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int expires Vector<string> pending_suggestions Vector<string> dismissed_suggestions Vector<Chat> chats Vector<User> users true proxy peer peer string psa_type string psa_message pendingsuggestion custom_pending_suggestion
 * @return help.PromoData
 */

final class PromoData extends Instance {
	public function request(int $expires,array $pending_suggestions,array $dismissed_suggestions,array $chats,array $users,? true $proxy = null,? object $peer = null,? string $psa_type = null,? string $psa_message = null,? object $custom_pending_suggestion = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x8a4d87a);
		$flags = 0;
		$flags |= is_null($proxy) ? 0 : (1 << 0);
		$flags |= is_null($peer) ? 0 : (1 << 3);
		$flags |= is_null($psa_type) ? 0 : (1 << 1);
		$flags |= is_null($psa_message) ? 0 : (1 << 2);
		$flags |= is_null($custom_pending_suggestion) ? 0 : (1 << 4);
		$writer->writeInt($flags);
		$writer->writeInt($expires);
		if(is_null($peer) === false):
			$writer->write($peer->read());
		endif;
		if(is_null($psa_type) === false):
			$writer->tgwriteBytes($psa_type);
		endif;
		if(is_null($psa_message) === false):
			$writer->tgwriteBytes($psa_message);
		endif;
		$writer->tgwriteVector($pending_suggestions,'string');
		$writer->tgwriteVector($dismissed_suggestions,'string');
		if(is_null($custom_pending_suggestion) === false):
			$writer->write($custom_pending_suggestion->read());
		endif;
		$writer->tgwriteVector($chats,'Chat');
		$writer->tgwriteVector($users,'User');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['proxy'] = true;
		else:
			$result['proxy'] = false;
		endif;
		$result['expires'] = $reader->readInt();
		if($flags & (1 << 3)):
			$result['peer'] = $reader->tgreadObject();
		else:
			$result['peer'] = null;
		endif;
		if($flags & (1 << 1)):
			$result['psa_type'] = $reader->tgreadBytes();
		else:
			$result['psa_type'] = null;
		endif;
		if($flags & (1 << 2)):
			$result['psa_message'] = $reader->tgreadBytes();
		else:
			$result['psa_message'] = null;
		endif;
		$result['pending_suggestions'] = $reader->tgreadVector('string');
		$result['dismissed_suggestions'] = $reader->tgreadVector('string');
		if($flags & (1 << 4)):
			$result['custom_pending_suggestion'] = $reader->tgreadObject();
		else:
			$result['custom_pending_suggestion'] = null;
		endif;
		$result['chats'] = $reader->tgreadVector('Chat');
		$result['users'] = $reader->tgreadVector('User');
		return new self($result);
	}
}

?>