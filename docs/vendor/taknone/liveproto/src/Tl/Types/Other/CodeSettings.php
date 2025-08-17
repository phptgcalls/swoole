<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param true allow_flashcall true current_number true allow_app_hash true allow_missed_call true allow_firebase true unknown_number Vector<bytes> logout_tokens string token bool app_sandbox
 * @return CodeSettings
 */

final class CodeSettings extends Instance {
	public function request(? true $allow_flashcall = null,? true $current_number = null,? true $allow_app_hash = null,? true $allow_missed_call = null,? true $allow_firebase = null,? true $unknown_number = null,? array $logout_tokens = null,? string $token = null,? bool $app_sandbox = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xad253d78);
		$flags = 0;
		$flags |= is_null($allow_flashcall) ? 0 : (1 << 0);
		$flags |= is_null($current_number) ? 0 : (1 << 1);
		$flags |= is_null($allow_app_hash) ? 0 : (1 << 4);
		$flags |= is_null($allow_missed_call) ? 0 : (1 << 5);
		$flags |= is_null($allow_firebase) ? 0 : (1 << 7);
		$flags |= is_null($unknown_number) ? 0 : (1 << 9);
		$flags |= is_null($logout_tokens) ? 0 : (1 << 6);
		$flags |= is_null($token) ? 0 : (1 << 8);
		$flags |= is_null($app_sandbox) ? 0 : (1 << 8);
		$writer->writeInt($flags);
		if(is_null($logout_tokens) === false):
			$writer->tgwriteVector($logout_tokens,'bytes');
		endif;
		if(is_null($token) === false):
			$writer->tgwriteBytes($token);
		endif;
		if(is_null($app_sandbox) === false):
			$writer->tgwriteBool($app_sandbox);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['allow_flashcall'] = true;
		else:
			$result['allow_flashcall'] = false;
		endif;
		if($flags & (1 << 1)):
			$result['current_number'] = true;
		else:
			$result['current_number'] = false;
		endif;
		if($flags & (1 << 4)):
			$result['allow_app_hash'] = true;
		else:
			$result['allow_app_hash'] = false;
		endif;
		if($flags & (1 << 5)):
			$result['allow_missed_call'] = true;
		else:
			$result['allow_missed_call'] = false;
		endif;
		if($flags & (1 << 7)):
			$result['allow_firebase'] = true;
		else:
			$result['allow_firebase'] = false;
		endif;
		if($flags & (1 << 9)):
			$result['unknown_number'] = true;
		else:
			$result['unknown_number'] = false;
		endif;
		if($flags & (1 << 6)):
			$result['logout_tokens'] = $reader->tgreadVector('bytes');
		else:
			$result['logout_tokens'] = null;
		endif;
		if($flags & (1 << 8)):
			$result['token'] = $reader->tgreadBytes();
		else:
			$result['token'] = null;
		endif;
		if($flags & (1 << 8)):
			$result['app_sandbox'] = $reader->tgreadBool();
		else:
			$result['app_sandbox'] = null;
		endif;
		return new self($result);
	}
}

?>